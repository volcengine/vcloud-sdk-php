<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: vod/request/request_vod.proto

namespace Volc\Service\Vod\Models\Request;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Volcengine.Models.Vod.Request.VodUploadMediaRequest</code>
 */
class VodUploadMediaRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string SpaceName = 1;</code>
     */
    protected $SpaceName = '';
    /**
     * Generated from protobuf field <code>string FilePath = 2;</code>
     */
    protected $FilePath = '';
    /**
     * Generated from protobuf field <code>string CallbackArgs = 3;</code>
     */
    protected $CallbackArgs = '';
    /**
     * Generated from protobuf field <code>string Functions = 4;</code>
     */
    protected $Functions = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $SpaceName
     *     @type string $FilePath
     *     @type string $CallbackArgs
     *     @type string $Functions
     * }
     */
    public function __construct($data = NULL) {
        \Volc\Service\Vod\Models\GPBMetadata\RequestVod::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string SpaceName = 1;</code>
     * @return string
     */
    public function getSpaceName()
    {
        return $this->SpaceName;
    }

    /**
     * Generated from protobuf field <code>string SpaceName = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSpaceName($var)
    {
        GPBUtil::checkString($var, True);
        $this->SpaceName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string FilePath = 2;</code>
     * @return string
     */
    public function getFilePath()
    {
        return $this->FilePath;
    }

    /**
     * Generated from protobuf field <code>string FilePath = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setFilePath($var)
    {
        GPBUtil::checkString($var, True);
        $this->FilePath = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string CallbackArgs = 3;</code>
     * @return string
     */
    public function getCallbackArgs()
    {
        return $this->CallbackArgs;
    }

    /**
     * Generated from protobuf field <code>string CallbackArgs = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setCallbackArgs($var)
    {
        GPBUtil::checkString($var, True);
        $this->CallbackArgs = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Functions = 4;</code>
     * @return string
     */
    public function getFunctions()
    {
        return $this->Functions;
    }

    /**
     * Generated from protobuf field <code>string Functions = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setFunctions($var)
    {
        GPBUtil::checkString($var, True);
        $this->Functions = $var;

        return $this;
    }

}
