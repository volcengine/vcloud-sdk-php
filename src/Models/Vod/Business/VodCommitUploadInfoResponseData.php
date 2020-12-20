<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: vod/business/vod_upload.proto

namespace Volc\Models\Vod\Business;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Volcengine.Models.Vod.Business.VodCommitUploadInfoResponseData</code>
 */
class VodCommitUploadInfoResponseData extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Vid = 1;</code>
     */
    protected $Vid = '';
    /**
     * Generated from protobuf field <code>.Volcengine.Models.Vod.Business.VodSourceInfo SourceInfo = 2;</code>
     */
    protected $SourceInfo = null;
    /**
     * Generated from protobuf field <code>string PosterUri = 3;</code>
     */
    protected $PosterUri = '';
    /**
     * Generated from protobuf field <code>string CallbackArgs = 4;</code>
     */
    protected $CallbackArgs = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $Vid
     *     @type \Volc\Models\Vod\Business\VodSourceInfo $SourceInfo
     *     @type string $PosterUri
     *     @type string $CallbackArgs
     * }
     */
    public function __construct($data = NULL) {
        \Volc\Models\Vod\GPBMetadata\VodUpload::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string Vid = 1;</code>
     * @return string
     */
    public function getVid()
    {
        return $this->Vid;
    }

    /**
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
     * Generated from protobuf field <code>.Volcengine.Models.Vod.Business.VodSourceInfo SourceInfo = 2;</code>
     * @return \Volc\Models\Vod\Business\VodSourceInfo
     */
    public function getSourceInfo()
    {
        return $this->SourceInfo;
    }

    /**
     * Generated from protobuf field <code>.Volcengine.Models.Vod.Business.VodSourceInfo SourceInfo = 2;</code>
     * @param \Volc\Models\Vod\Business\VodSourceInfo $var
     * @return $this
     */
    public function setSourceInfo($var)
    {
        GPBUtil::checkMessage($var, \Volc\Models\Vod\Business\VodSourceInfo::class);
        $this->SourceInfo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string PosterUri = 3;</code>
     * @return string
     */
    public function getPosterUri()
    {
        return $this->PosterUri;
    }

    /**
     * Generated from protobuf field <code>string PosterUri = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setPosterUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->PosterUri = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string CallbackArgs = 4;</code>
     * @return string
     */
    public function getCallbackArgs()
    {
        return $this->CallbackArgs;
    }

    /**
     * Generated from protobuf field <code>string CallbackArgs = 4;</code>
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

