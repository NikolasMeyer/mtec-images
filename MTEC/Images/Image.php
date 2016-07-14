<?php

namespace MTEC\Images {

    /**
     * Represent a single image
     */
    class Image {
        protected $_src = null;

        const TYPE_PNG = 'png';
        const TYPE_JPG = 'jpg';
        const TYPE_GIF = 'gif';
        const TYPE_UNKONWN = 'unknown';

        /**
         * Class Constructor
         * @param string $src path to the image
         */
        public function __construct($src) {
            $this->setSrc($src);
        }

        public function setSrc($src) {
            if (!file_exists($src)) {
                throw new \Exception('The file "' . $src . '" does not exist!');
            }

            if (!is_readable($src)) {
                throw new \Exception('The file "' . $src . '" readable!');
            }
            $this->_src = $src;
        }

        public function getSrc() {
            return $this->_src;
        }

        public function getType() {
            $type = exif_imagetype($this->_src);
            switch($type) {
                case IMAGETYPE_GIF:
                    return self::TYPE_GIF;
                case IMAGETYPE_JPEG:
                    return self::TYPE_JPG;
                case IMAGETYPE_PNG:
                    return self::TYPE_PNG;
                default:
                    return self::TYPE_UNKONWN;
            }
        }
    }
}
