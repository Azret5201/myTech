<?php


namespace App\Services\File\Enum;

use MyCLabs\Enum\Enum;


/**
 * @method static static LOCAL()
 * @method static static PRODUCT_PATH()
 * @method static static PRODUCT_THUMBS_PATH()
 * @method static static EDITOR_LIBRARY_PATH()
 * @method static static EDITOR_LIBRARY_THUMBS_PATH()
 */
class Disk extends Enum
{
    private const LOCAL = 'local';
    private const LOCAL_PATH = 'storage/images/';
    private const LOCAL_ORDER_PATH = 'storage/';
    private const PRODUCT_PATH = 'storage/images/';
    private const PRODUCT_THUMBS_PATH = 'storage/images/thumbs/';
    private const EDITOR_LIBRARY_PATH = 'storage/images/editor_library/';
    private const EDITOR_LIBRARY_THUMBS_PATH = 'storage/images/editor_library/thumbs/';

    public function getValueLocal()
    {
        return self::LOCAL;
    }
}
