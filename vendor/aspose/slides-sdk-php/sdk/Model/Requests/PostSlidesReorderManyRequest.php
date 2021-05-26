<?php
/**
 * --------------------------------------------------------------------------------------------------------------------
 * <copyright company="Aspose">
 *   Copyright (c) 2018 Aspose.Slides for Cloud
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------------------------------------------
 */


namespace Aspose\Slides\Cloud\Sdk\Model\Requests;
/*
 * Request model for postSlidesReorderMany operation.
 */
class PostSlidesReorderManyRequest
{
    /*
     * Document name.
     */
    public $name;

    /*
     * A comma separated array of positions of slides to be reordered.
     */
    public $oldPositions;

    /*
     * A comma separated array of new slide positions.
     */
    public $newPositions;

    /*
     * Document password.
     */
    public $password;

    /*
     * Document folder.
     */
    public $folder;

    /*
     * Document storage.
     */
    public $storage;

    /*
     * Initializes a new instance of the PostSlidesReorderManyRequest class.
     *  
     * @param string $name Document name.
     * @param array $oldPositions A comma separated array of positions of slides to be reordered.
     * @param array $newPositions A comma separated array of new slide positions.
     * @param string $password Document password.
     * @param string $folder Document folder.
     * @param string $storage Document storage.
     */
    public function __construct($name, $oldPositions = null, $newPositions = null, $password = null, $folder = null, $storage = null)
    {
        $this->name = $name;
        $this->oldPositions = $oldPositions;
        $this->newPositions = $newPositions;
        $this->password = $password;
        $this->folder = $folder;
        $this->storage = $storage;
    }

    /*
     * Document name.
     */
    public function get_name()
    {
        return $this->name;
    }

    /*
     * Document name.
     */
    public function set_name($value)
    {
        $this->name = $value;
        return $this;
    }
    /*
     * A comma separated array of positions of slides to be reordered.
     */
    public function get_oldPositions()
    {
        return $this->oldPositions;
    }

    /*
     * A comma separated array of positions of slides to be reordered.
     */
    public function set_oldPositions($value)
    {
        $this->oldPositions = $value;
        return $this;
    }
    /*
     * A comma separated array of new slide positions.
     */
    public function get_newPositions()
    {
        return $this->newPositions;
    }

    /*
     * A comma separated array of new slide positions.
     */
    public function set_newPositions($value)
    {
        $this->newPositions = $value;
        return $this;
    }
    /*
     * Document password.
     */
    public function get_password()
    {
        return $this->password;
    }

    /*
     * Document password.
     */
    public function set_password($value)
    {
        $this->password = $value;
        return $this;
    }
    /*
     * Document folder.
     */
    public function get_folder()
    {
        return $this->folder;
    }

    /*
     * Document folder.
     */
    public function set_folder($value)
    {
        $this->folder = $value;
        return $this;
    }
    /*
     * Document storage.
     */
    public function get_storage()
    {
        return $this->storage;
    }

    /*
     * Document storage.
     */
    public function set_storage($value)
    {
        $this->storage = $value;
        return $this;
    }
}