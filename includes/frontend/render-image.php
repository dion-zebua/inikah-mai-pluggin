<?php

namespace Inikah_Mai\FrontEnd;

if (!defined('ABSPATH')) {
    exit;
}
if (! class_exists('Inikah_Mai\\FrontEnd\\Render_Image')) {

    class Render_Image
    {

        private function __construct()
        {
            $this->render();
            // add_action('template_redirect', [$this, 'render']);

        }

        public function render()
        {
            $slug = get_option('mai_image_permalink') ?: INIKAH_MAI__IMAGE_PERMALINK;

            $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


            if (!preg_match('#^' . preg_quote($slug, '#') . '/(.+)$#', $path, $matches)) {
                return;
            }

            $title = rawurldecode($matches[1]);
            $this->generate_image($title);
        }

        private function generate_image(string $title)
        {
            status_header(200);
            header('Content-Type: image/webp');

            $bg_path = get_option('mai_image_default_bg') ?: INIKAH_MAI__DIR_PATH . INIKAH_MAI__DEFAULT_BG;

            $image = $this->create_image_type($bg_path);

            $font_size = (int) (get_option('mai_image_font_size') ?: INIKAH_MAI__FONT_SIZE);
            $draw_font_size = $font_size + 70;

            $rgb = $this->hex_to_dec(
                get_option('mai_image_text_color') ?: INIKAH_MAI__TEXT_COLOR
            );

            $text_color = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);

            $font_weight = get_option(
                'mai_image_font_weight',
                INIKAH_MAI__FONT_WEIGHT
            );

            $font = $this->get_font($font_weight);

            $text_align = get_option('mai_image_text_align') ?: INIKAH_MAI__TEXT_ALIGN;

            $image_width  = imagesx($image);
            $image_height = imagesy($image);

            $padding = 80;

            // Pecah teks otomatis
            $lines = $this->wrap_text(
                $title,
                $font,
                $draw_font_size,
                $image_width - ($padding * 2)
            );

            $line_height = $draw_font_size * (float) (get_option('mai_image_line_height') ?:  INIKAH_MAI__LINE_HEIGHT);

            // Hitung tinggi total
            $total_height = count($lines) * $line_height;

            // Posisi awal Y agar semua blok teks berada di tengah
            $y = (($image_height - $total_height) / 2) + $draw_font_size;

            foreach ($lines as $line) {

                $bbox = imagettfbbox($draw_font_size, 0, $font, $line);

                $minX = min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
                $maxX = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]);

                $text_width = $maxX - $minX;

                switch ($text_align) {
                    case 'left':
                        $x = $padding - $minX;
                        break;

                    case 'right':
                        $x = $image_width - $text_width - $padding - $minX;
                        break;

                    case 'center':
                    default:
                        $x = (($image_width - $text_width) / 2) - $minX;
                        break;
                }

                imagettftext(
                    $image,
                    $draw_font_size,
                    0,
                    (int) $x,
                    (int) $y,
                    $text_color,
                    $font,
                    $line
                );

                $y += $line_height;
            }

            imagewebp($image, null, 90);

            imagedestroy($image);
            exit;
        }

        private function wrap_text(String $text, String $font, int $fontSize, int $maxWidth)
        {
            $words = preg_split('/\s+/', trim($text));
            $lines = [];
            $currentLine = '';

            foreach ($words as $word) {
                $testLine = $currentLine === '' ? $word : $currentLine . ' ' . $word;

                $bbox = imagettfbbox($fontSize, 0, $font, $testLine);

                $minX = min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
                $maxX = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]);

                $textWidth = $maxX - $minX;

                if ($textWidth <= $maxWidth) {
                    $currentLine = $testLine;
                } else {
                    if ($currentLine !== '') {
                        $lines[] = $currentLine;
                    }
                    $currentLine = $word;
                }
            }

            if ($currentLine !== '') {
                $lines[] = $currentLine;
            }

            return $lines;
        }

        private function create_image_type($bg_path)
        {
            switch (strtolower(pathinfo($bg_path, PATHINFO_EXTENSION))) {
                case 'jpg':
                case 'jpeg':
                    return imagecreatefromjpeg($bg_path);

                case 'png':
                    return imagecreatefrompng($bg_path);

                case 'webp':
                    return imagecreatefromwebp($bg_path);

                default:
                    wp_die('Format background tidak didukung');
            }
        }

        private function get_font($font_weight)
        {
            if ($font_weight === 'bold') {
                return INIKAH_MAI__DIR_PATH . 'assets/font/Inter-Bold.ttf';
            } elseif ($font_weight === 'medium') {
                return INIKAH_MAI__DIR_PATH . 'assets/font/Inter-Medium.ttf';
            } else {
                return INIKAH_MAI__DIR_PATH . 'assets/font/Inter-Normal.ttf';
            }
        }

        private function hex_to_dec($hex)
        {
            $text_color = ltrim($hex, '#');

            $r = hexdec(substr($text_color, 0, 2));
            $g = hexdec(substr($text_color, 2, 2));
            $b = hexdec(substr($text_color, 4, 2));

            return [$r, $g, $b];
        }

        public static function get_instance()
        {
            static $instance = null;

            if (is_null($instance)) {
                $instance = new self();
            }

            return $instance;
        }
    }
}
