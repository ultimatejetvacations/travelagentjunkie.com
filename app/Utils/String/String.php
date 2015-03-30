<?php namespace App\Utils\String;

use Illuminate\Support\Str;

class String extends Str {

    public function BBCode2Html($text)
    {
        $text = trim($text);

        // BBCode to find...
        $in = array( 	 '/\[b\](.*?)\[\/b\]/ms',
            '/\[red\](.*?)\[\/red\]/ms',
            '/\[blue\](.*?)\[\/blue\]/ms',
            '/\[green\](.*?)\[\/green\]/ms',
            '/\[yellowBG\](.*?)\[\/yellowBG\]/ms',
            '/\[i\](.*?)\[\/i\]/ms',
            '/\[u\](.*?)\[\/u\]/ms',
            '/\[img\](.*?)\[\/img\]/ms',
            '/\[email\](.*?)\[\/email\]/ms',
            '/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms',
            '/\[size\="?(.*?)"?\](.*?)\[\/size\]/ms',
            '/\[color\="?(.*?)"?\](.*?)\[\/color\]/ms',
            '/\[quote](.*?)\[\/quote\]/ms',
            '/\[list\=(.*?)\](.*?)\[\/list\]/ms',
            '/\[list\](.*?)\[\/list\]/ms',
            '/\[\*\]\s?(.*?)\n/ms'
        );

        // And replace them by...
        $out = array(	 '<strong>\1</strong>',
            '<span style="color:#EB0511">\1</span>',
            '<span style="color:#3286C7">\1</span>',
            '<span style="color:#37B164">\1</span>',
            '<span style="background:yellow">\1</span>',
            '<em>\1</em>',
            '<u>\1</u>',
            '<img src="\1" alt="\1" />',
            '<a href="mailto:\1">\1</a>',
            '<a href="\1">\2</a>',
            '<span style="font-size:\1%">\2</span>',
            '<span style="color:\1">\2</span>',
            '<blockquote>\1</blockquote>',
            '<ol start="\1">\2</ol>',
            '<ul>\1</ul>',
            '<li>\1</li>'
        );
        $text = preg_replace($in, $out, $text);

        // paragraphs
        $text = str_replace("\r", "", $text);
        $text = "<p>".preg_replace("/(\n){2,}/", "</p><p>", $text)."</p>";
        $text = nl2br($text);

        $text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', [$this, 'removeBr'], $text);
        $text = preg_replace_callback('/<h2>(.*?)<\/h2><br \/>/ms', [$this, 'removeBr'], $text);
        $text = preg_replace_callback('/<ol start\="(.*?)">(.*?)<\/ol>/ms', [$this, 'removeBr'], $text);
        $text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);
        $text = preg_replace('/<p><h2>(.*?)<\/h2><\/p>/ms', "<h2>\\1</h2>", $text);
        $text = preg_replace('/<p><h2>(.*?)<\/h2>/ms', "<h2>\\1</h2><p>", $text);

        return $text;
    }

    // clean some tags to remain strict
    // not very elegant, but it works. No time to do better ;)
    public function removeBr($text ) {
        return str_replace("<br />", "", $text [0]);
    }
    
}