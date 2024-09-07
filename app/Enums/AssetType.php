<?php

namespace App\Enums;

enum AssetType: string
{
    case IMAGE = "Image"; //jpg, gif, png, tiff, psd, cdr, ai, svg
    case DOCUMENT = "Document"; // pdf, doc, docx, txt
    case VIDEO = "Video"; // mp4, webm, mkv
    case AUDIO = "Audio"; // mp3, aav
    case ARCHIVE = "Archive"; // zip, tar, gz
    case SPREADSHEET = "Spreadsheet"; // csv, xls, xlsx
    case DATA = "Data"; // json, xml, yml
    case UNIDENTIFIED = "Unidentified"; // any other file.

    public const IMAGE_TYPE = [
        "jpg", "gif", "png", "webp", "psd", "ai", "svg", "ico"
    ];

    public const DOCUMENT_TYPE = [
        "pdf", "doc", "docx", "txt", "csv", "md", "html", "log"
    ];

    public const VIDEO_TYPE = [
        "mp4", "mkv"
    ];

    public const AUDIO_TYPE = [
        "mp3", "m4a", "aac"
    ];

    public const DATA_TYPE = [
        "json", "xml", "yml", "yaml"
    ];

    public static function detect($filetype) {
        if(in_array($filetype, self::IMAGE_TYPE)) {
            return self::IMAGE;
        }
        if(in_array($filetype, self::DOCUMENT_TYPE)) {
            return self::DOCUMENT;
        }
        if(in_array($filetype, self::VIDEO_TYPE)) {
            return self::VIDEO;
        }
        if(in_array($filetype, self::AUDIO_TYPE)) {
            return self::AUDIO;
        }
        if(in_array($filetype, self::DATA_TYPE)) {
            return self::DATA;
        }
        return self::UNIDENTIFIED;
    }
}

