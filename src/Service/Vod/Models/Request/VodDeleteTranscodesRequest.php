<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: vod/request/request_vod.proto

namespace Volc\Service\Vod\Models\Request;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Volcengine.Models.Vod.Request.VodDeleteTranscodesRequest</code>
 */
class VodDeleteTranscodesRequest extends \Google\Protobuf\Internal\Message
{
    /**
     *视频ID
     *
     * Generated from protobuf field <code>string Vid = 1;</code>
     */
    protected $Vid = '';
    /**
     *转码视频ID列表
     *
     * Generated from protobuf field <code>string FileIds = 2;</code>
     */
    protected $FileIds = '';
    /**
     *回调回传参数
     *
     * Generated from protobuf field <code>string CallbackArgs = 3;</code>
     */
    protected $CallbackArgs = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $Vid
     *          视频ID
     *     @type string $FileIds
     *          转码视频ID列表
     *     @type string $CallbackArgs
     *          回调回传参数
     * }
     */
    public function __construct($data = NULL) {
        \Volc\Service\Vod\Models\GPBMetadata\RequestVod::initOnce();
        parent::__construct($data);
    }

    /**
     *视频ID
     *
     * Generated from protobuf field <code>string Vid = 1;</code>
     * @return string
     */
    public function getVid()
    {
        return $this->Vid;
    }

    /**
     *视频ID
     *
     * Generated from protobuf field <code>string Vid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setVid($var)
    {
        GPBUtil::checkString($var, True);
        $this->Vid = $var;

        return $this;
    }

    /**
     *转码视频ID列表
     *
     * Generated from protobuf field <code>string FileIds = 2;</code>
     * @return string
     */
    public function getFileIds()
    {
        return $this->FileIds;
    }

    /**
     *转码视频ID列表
     *
     * Generated from protobuf field <code>string FileIds = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setFileIds($var)
    {
        GPBUtil::checkString($var, True);
        $this->FileIds = $var;

        return $this;
    }

    /**
     *回调回传参数
     *
     * Generated from protobuf field <code>string CallbackArgs = 3;</code>
     * @return string
     */
    public function getCallbackArgs()
    {
        return $this->CallbackArgs;
    }

    /**
     *回调回传参数
     *
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

}
