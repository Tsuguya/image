<?php

namespace Intervention\Image\Drivers\Imagick\Encoders;

use Imagick;
use Intervention\Image\Drivers\Abstract\Encoders\AbstractEncoder;
use Intervention\Image\Drivers\Imagick\Modifiers\LimitColorsModifier;
use Intervention\Image\EncodedImage;
use Intervention\Image\Interfaces\EncoderInterface;
use Intervention\Image\Interfaces\ImageInterface;

class PngEncoder extends AbstractEncoder implements EncoderInterface
{
    public function __construct(protected int $color_limit = 0)
    {
        //
    }

    public function encode(ImageInterface $image): EncodedImage
    {
        $format = 'png';
        $compression = Imagick::COMPRESSION_ZIP;

        $image = $image->modify(new LimitColorsModifier($this->color_limit));
        $imagick = $image->frame()->core();
        $imagick->setFormat($format);
        $imagick->setImageFormat($format);
        $imagick->setCompression($compression);
        $imagick->setImageCompression($compression);

        return new EncodedImage($imagick->getImagesBlob(), 'image/png');
    }
}
