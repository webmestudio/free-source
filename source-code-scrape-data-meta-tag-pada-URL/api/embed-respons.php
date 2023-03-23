<?php 

/**
$info->title; //The page title
$info->description; //The page description
$info->url; //The canonical url
$info->type; //The page type (link, video, image, rich)
$info->tags; //The page keywords (tags)

$info->images; //List of all images found in the page
$info->image; //The image choosen as main image
$info->imageWidth; //The width of the main image
$info->imageHeight; //The height of the main image

$info->code; //The code to embed the image, video, etc
$info->width; //The width of the embed code
$info->height; //The height of the embed code
$info->aspectRatio; //The aspect ratio (width/height)

$info->authorName; //The resource author 
$info->authorUrl; //The author url

$info->providerName; //The provider name of the page (Youtube, Twitter, Instagram, etc)
$info->providerUrl; //The provider url
$info->providerIcons; //All provider icons found in the page
$info->providerIcon; //The icon choosen as main icon

$info->publishedDate; //The published date of the resource
$info->license; //The license url of the resource
$info->linkedData; //The linked-data info (http://json-ld.org/)
*/

/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');*/

use Embed\Embed;
require '../Embed/autoloader.php';

if(isset($_POST))
{
	$link = $_POST['url'];

    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        $respons['errorLink'] = true;
    }
    else
    {
        if(@fsockopen(parse_link($link), 80, $iErrno, $sErrStr, 5)) 
        {
            $info = Embed::create($link);
            
            $respons = [
                'title' => $info->title,
                'description' => $info->description,
                'url' => $info->url,
                'image' => $info->image,
                'imageWidth' => $info->imageWidth,
                'imageHeight' => $info->imageHeight,
                'providerIcon' => $info->providerIcon,
                'providerIcons' => $info->providerIcons,
                'providerName' => $info->providerName,
                'providerUrl' => parse_link($info->providerUrl)
            ];
        }
        else
        {
            $respons['errorSocket'] = true;
        }
    }

    echo json_encode($respons);
}

function parse_link($link)
{
    $parseUrl = parse_url(trim($link)); 
    return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2))); 
}

?>