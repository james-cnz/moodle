<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace core_badges;

/**
 * Information on PNG file chunks can be found at http://www.w3.org/TR/PNG/#11Chunks
 * Some other info on PNG that I used http://garethrees.org/2007/11/14/pngcrush/
 *
 * Example of use:
 * $png = new png_metadata_handler('file.png');
 *
 * if ($png->check_chunks("tEXt", "openbadge")) {
 *     $newcontents = $png->add_chunks("tEXt", "openbadge", 'http://some.public.url/to.your.assertion.file');
 * }
 *
 * file_put_contents('file.png', $newcontents);
 */

/**
 * Baking badges - PNG metadata handler.
 *
 * @package    core_badges
 * @copyright  2012 onwards Totara Learning Solutions Ltd {@link http://www.totaralms.com/}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Yuliya Bozhko <yuliya.bozhko@totaralms.com>
 */
class png_metadata_handler
{
    /** @var string File content as a string */
    private string $_contents;
    /** @var int Length of the image file */
    private int $_size;
    /** @var array Variable for storing parsed chunks */
    private array $_chunks;

    /**
     * Prepares file for handling metadata.
     * Verifies that this file is a valid PNG file.
     * Unpacks file chunks and reads them into an array.
     *
     * @param string $contents File content as a string
     */
    public function __construct(string $contents) {
        $this->_contents = $contents;
        $png_signature = pack("C8", 137, 80, 78, 71, 13, 10, 26, 10);

        // Read 8 bytes of PNG header and verify.
        $header = substr($this->_contents, 0, 8);

        if ($header != $png_signature) {
            debugging('This is not a valid PNG image');
        }

        $this->_size = strlen($this->_contents);

        $this->_chunks = array();

        // Skip 8 bytes of IHDR image header.
        $position = 8;
        do {
            $chunk = @unpack('Nsize/a4type', substr($this->_contents, $position, 8));
            $this->_chunks[$chunk['type']][] = substr($this->_contents, $position + 8, $chunk['size']);

            // Skip 12 bytes chunk overhead.
            $position += $chunk['size'] + 12;
        } while ($position < $this->_size);
    }

    /**
     * Checks if a key already exists in the chunk of said type.
     * We need to avoid writing same keyword into file chunks.
     *
     * @param string $type Chunk type, like iTXt, tEXt, etc.
     * @param string $check Keyword that needs to be checked.
     *
     * @return boolean (true|false) True if file is safe to write this keyword, false otherwise.
     */
    public function check_chunks(string $type, string $check): bool {
        if (array_key_exists($type, $this->_chunks)) {
            foreach (array_keys($this->_chunks[$type]) as $typekey) {
                list($key, $data) = explode("\0", $this->_chunks[$type][$typekey]);

                if (strcmp($key, $check) == 0) {
                    debugging('Key "' . $check . '" already exists in "' . $type . '" chunk.');
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Adds a chunk with keyword and data to the file content.
     * Chunk is added to the end of the file, before IEND image trailer.
     *
     * @param string $type Chunk type, like iTXt, tEXt, etc.
     * @param string $key Keyword that needs to be added.
     * @param string $value Currently an assertion URL that is added to an image metadata.
     *
     * @return string $result File content with a new chunk as a string. Can be used in file_put_contents() to write to a file.
     * @throws \moodle_exception when unsupported chunk type is defined.
     */
    public function add_chunks(string $type, string $key, string $value): string {
        if (strlen($key) > 79) {
            debugging('Key is too big');
        }

        $dataparts = [];
        if ($type === 'iTXt') {
            // International textual data (iTXt).
            // Keyword:             1-79 bytes (character string).
            $dataparts[] = $key;
            // Null separator:      1 byte.
            $dataparts[] = "\x00";
            // Compression flag:    1 byte
            // A value of 0 means no compression.
            $dataparts[] = "\x00";
            // Compression method:  1 byte
            // If compression is disabled, the method should also be 0.
            $dataparts[] = "\x00";
            // Language tag:        0 or more bytes (character string)
            // When there is no language specified leave empty.

            // Null separator:      1 byte.
            $dataparts[] = "\x00";
            // Translated keyword:  0 or more bytes
            // When there is no translation specified, leave empty.

            // Null separator:      1 byte.
            $dataparts[] = "\x00";
            // Text:                0 or more bytes.
            $dataparts[] = $value;
        } else if ($type === 'tEXt') {
            // Textual data (tEXt).
            // Keyword:             1-79 bytes (character string).
            $dataparts[] = $key;
            // Null separator:      1 byte.
            $dataparts[] = "\0";
            // Text:                n bytes (character string).
            $dataparts[] = $value;
        } else {
            throw new \moodle_exception('Unsupported chunk type: ' . $type);
        }

        $data = implode($dataparts);

        $crc = pack("N", crc32($type . $data));
        $len = pack("N", strlen($data));

        // Chunk format: length + type + data + CRC.
        // CRC is a CRC-32 computed over the chunk type and chunk data.
        $newchunk = $len . $type . $data . $crc;
        $this->_chunks[$type] = $data;

        $result = substr($this->_contents, 0, $this->_size - 12)
                . $newchunk
                . substr($this->_contents, $this->_size - 12, 12);

        return $result;
    }
}
