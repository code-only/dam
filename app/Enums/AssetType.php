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
    case SCRIPT = "Script"; // any other file.

    public const MAP = [
        "jpg" => self::IMAGE,
        "jpeg" => self::IMAGE,
        "gif" => self::IMAGE,
        "png" => self::IMAGE,
        "webp" => self::IMAGE,
        "bmp" => self::IMAGE,
        "eps" => self::IMAGE,
        "raw" => self::IMAGE,
        "heif" => self::IMAGE,
        "heic" => self::IMAGE,
        "jfif" => self::IMAGE,
        "psd" => self::IMAGE,
        "ai" => self::IMAGE,
        "svg" => self::IMAGE,
        "ico" => self::IMAGE,
        "tiff" => self::IMAGE,
        "pdf" => self::DOCUMENT,
        "doc" => self::DOCUMENT,
        "docx" => self::DOCUMENT,
        "odt" => self::DOCUMENT,
        "rtf" => self::DOCUMENT,
        "txt" => self::DOCUMENT,
        "docm" => self::DOCUMENT,
        "rst" => self::DOCUMENT,
        "md" => self::DOCUMENT,
        "htm" => self::DOCUMENT,
        "html" => self::DOCUMENT,
        "log" => self::DOCUMENT,
        "json" => self::DATA,
        "xml" => self::DATA,
        "yml" => self::DATA,
        "yaml" => self::DATA,
        "toml" => self::DATA,
        "mp4" => self::VIDEO,
        "mkv" => self::VIDEO,
        "wmv" => self::VIDEO,
        "avi" => self::VIDEO,
        "mov" => self::VIDEO,
        "flv" => self::VIDEO,
        "webm" => self::VIDEO,
        "3gp" => self::VIDEO,
        "3gpp" => self::VIDEO,
        "vob" => self::VIDEO,
        "mp3" => self::AUDIO,
        "aac" => self::AUDIO,
        "weba" => self::AUDIO,
        "wma" => self::AUDIO,
        "wav" => self::AUDIO,
        "flac" => self::AUDIO,
        "zip" => self::ARCHIVE,
        "tar" => self::ARCHIVE,
        "gz" => self::ARCHIVE,
        "7z" => self::ARCHIVE,
        "iso" => self::ARCHIVE,
        "dmg" => self::ARCHIVE,
        "tz" => self::ARCHIVE,
        "img" => self::ARCHIVE,
        "rar" => self::ARCHIVE,
        "csv" => self::SPREADSHEET,
        "xls" => self::SPREADSHEET,
        "xlsx" => self::SPREADSHEET,
        "sh" => self::SCRIPT,
        "php" => self::SCRIPT,
        "js" => self::SCRIPT,
        "jsx" => self::SCRIPT,
        "asp" => self::SCRIPT,
        "aspx" => self::SCRIPT,
        "py" => self::SCRIPT,
    ];

    /**
     * @param $filetype
     * @return AssetType
     */
    public static function detect($filetype): AssetType {
        if(array_key_exists($filetype, self::MAP)) {
            return self::MAP[$filetype];
        }
        return self::UNIDENTIFIED;
    }
}

