<?php
/**
 * @author Nikolas Meyer <dev@nikolas-meyer.de>
 */

namespace MTEC\Images {

    use \MTEC\Images\Image;

    abstract class Optimizer {

        protected static $_optimizer = [
            Image::TYPE_PNG => Optimizer\OptiPNG::class,
            Image::TYPE_JPG => Optimizer\JPEGOptim::class
        ];

        protected $_binaryPath = '/dev/null';

        abstract protected function _doOptimization(\MTEC\Images\Image $image);

        public function setBinaryPath($binaryPath) {
            $this->isInstalled($binaryPath);
            $this->_binaryPath = $binaryPath;
        }

        public function isIstalled($path = null) {
            if (!$path) {
                $path = $this->_binaryPath;
            }

            if (!file_exists($path)) {
                return false;
            }

            if (!is_executable($path)) {
                return false;
            }

            return true;
        }

        public function optimize(\MTEC\Images\Image $image) {
            $this->_doOptimization($image);
        }

        protected function _exec($command) {
            if (is_array($command)) {
                $command = implode(' ', $command);
            }

            $result = [
                'output' => null,
                'exit_code' => null,
                'return' => null,
            ];
            $output = &$result['output'];
            $returnVar = &$result['exit_code'];
            $return = &$result['return'];

            $return = exec($command, $output, $returnVar);

            return $result;
        }

        public static function autodetect(\MTEC\Images\Image $image) {
            $optimizer = static::$_optimizer;

            $imageType = $image->getType();

            if (isset($optimizer[$imageType])) {
                return new $optimizer[$imageType];
            }

            throw new  \Excpetion ('Image Type "' . $imageType . '" is not implemented');
        }
    }
}
