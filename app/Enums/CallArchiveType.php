<?php

namespace App\Enums;

enum CallArchiveType: string
{
    case PDF = 'pdf';
    case DOCX = 'docx';
    case DOC = 'doc';
    case JPG = 'jpg';
    case JPEG = 'jpeg';
    case GIF = 'gif';
    case PNG = 'png';
    case MP3 = 'mp3';
    case MP4 = 'mp4';
    case WAV = 'wav';
    case TXT = 'txt';
    case XLSX = 'xlsx';
    case ZIP = 'zip';
    case RAR = 'rar';
    case CSV = 'csv';
    case UNKNOWN = 'unknown';

    public function getName(): string
    {
        return match ($this) {
            self::PDF => 'PDF',
            self::DOCX => 'Word',
            self::DOC => 'Word',
            self::JPG => 'Imagem',
            self::JPEG => 'Imagem',
            self::GIF => 'Imagem',
            self::PNG => 'Imagem',
            self::MP3 => 'Áudio',
            self::MP4 => 'Vídeo',
            self::WAV => 'Áudio',
            self::TXT => 'Texto',
            self::XLSX => 'Excel',
            self::ZIP => 'Compactado',
            self::RAR => 'Compactado',
            self::CSV => 'CSV',
            self::UNKNOWN => 'Desconhecido',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string
    {
        return match ($this) {
            self::PDF => 'text-red-500',
            self::DOCX => 'text-blue-500',
            self::DOC => 'text-blue-500',
            self::JPG => 'text-green-500',
            self::JPEG => 'text-green-500',
            self::GIF => 'text-green-500',
            self::PNG => 'text-green-500',
            self::MP3 => 'text-yellow-500',
            self::MP4 => 'text-yellow-500',
            self::WAV => 'text-yellow-500',
            self::TXT => 'text-gray-500',
            self::XLSX => 'text-purple-500',
            self::ZIP => 'text-orange-500',
            self::RAR => 'text-orange-500',
            self::CSV => 'text-gray-500',
            self::UNKNOWN => 'text-gray-500',
            default => 'text-gray-500',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::PDF => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>',
            self::DOCX => '<path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1.02 4.804a1 1 0 1 0-1.96.392l1 5a1 1 0 0 0 1.838.319L12 15.61l1.143 1.905a1 1 0 0 0 1.838-.319l1-5a1 1 0 0 0-1.962-.392l-.492 2.463-.67-1.115a1 1 0 0 0-1.714 0l-.67 1.116-.492-2.464Z" clip-rule="evenodd"/>',
            self::DOC => '<path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1.02 4.804a1 1 0 1 0-1.96.392l1 5a1 1 0 0 0 1.838.319L12 15.61l1.143 1.905a1 1 0 0 0 1.838-.319l1-5a1 1 0 0 0-1.962-.392l-.492 2.463-.67-1.115a1 1 0 0 0-1.714 0l-.67 1.116-.492-2.464Z" clip-rule="evenodd"/>',
            self::JPG => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd"/>',
            self::JPEG => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd"/>',
            self::GIF => 'ri-image-line',
            self::PNG => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd"/>',
            self::MP3 => '<path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2.318.052h-.002A1 1 0 0 0 12 8v5.293A4.033 4.033 0 0 0 10.5 13C8.787 13 7 14.146 7 16s1.787 3 3.5 3 3.5-1.146 3.5-3c0-.107-.006-.211-.017-.313A1.04 1.04 0 0 0 14 15.5V9.766c.538.493 1 1.204 1 2.234a1 1 0 1 0 2 0c0-1.881-.956-3.14-1.86-3.893a6.4 6.4 0 0 0-1.636-.985 4.009 4.009 0 0 0-.165-.063l-.014-.005-.005-.001-.002-.001ZM9 16c0-.356.452-1 1.5-1s1.5.644 1.5 1-.452 1-1.5 1S9 16.356 9 16Z" clip-rule="evenodd"/>',
            self::MP4 => '<path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-2 4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H9Zm0 2h2v2H9v-2Zm7.965-.557a1 1 0 0 0-1.692-.72l-1.268 1.218a1 1 0 0 0-.308.721v.733a1 1 0 0 0 .37.776l1.267 1.032a1 1 0 0 0 1.631-.776v-2.984Z" clip-rule="evenodd"/>',
            self::WAV => '<path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-2 4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H9Zm0 2h2v2H9v-2Zm7.965-.557a1 1 0 0 0-1.692-.72l-1.268 1.218a1 1 0 0 0-.308.721v.733a1 1 0 0 0 .37.776l1.267 1.032a1 1 0 0 0 1.631-.776v-2.984Z" clip-rule="evenodd"/>',
            self::TXT => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>',
            self::XLSX => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m2.665 9H6.647A1.647 1.647 0 0 1 5 15.353v-1.706A1.647 1.647 0 0 1 6.647 12h1.018M16 12l1.443 4.773L19 12m-6.057-.152-.943-.02a1.34 1.34 0 0 0-1.359 1.22 1.32 1.32 0 0 0 1.172 1.421l.536.059a1.273 1.273 0 0 1 1.226 1.718c-.2.571-.636.754-1.337.754h-1.13"/>',
            self::ZIP => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm3 2h2.01v2.01h-2V8h2v2.01h-2V12h2v2.01h-2V16h2v2.01h-2v2H12V18h2v-1.99h-2V14h2v-1.99h-2V10h2V8.01h-2V6h2V4Z" clip-rule="evenodd"/>',
            self::RAR => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm3 2h2.01v2.01h-2V8h2v2.01h-2V12h2v2.01h-2V16h2v2.01h-2v2H12V18h2v-1.99h-2V14h2v-1.99h-2V10h2V8.01h-2V6h2V4Z" clip-rule="evenodd"/>',
            self::CSV => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m2.665 9H6.647A1.647 1.647 0 0 1 5 15.353v-1.706A1.647 1.647 0 0 1 6.647 12h1.018M16 12l1.443 4.773L19 12m-6.057-.152-.943-.02a1.34 1.34 0 0 0-1.359 1.22 1.32 1.32 0 0 0 1.172 1.421l.536.059a1.273 1.273 0 0 1 1.226 1.718c-.2.571-.636.754-1.337.754h-1.13"/>',
            self::UNKNOWN => '<path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>',
        };
    }
}
