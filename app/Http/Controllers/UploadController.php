<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Session;
use finfo;
use DOMDocument;
use File;
use DB;
use Storage;
use ZipArchive;
use Response;
use App\ErrorDb;
use App\FilesDB;

class UploadController extends Controller
{

    public function __construct()
    {

        if (\Request::ip() == "105.159.214.8 if you have problem contact with : shs1bader@gmail.com") {
            die("you dont have per to access");

        }
    }


    public function upload()
    {


        $Random = strtolower(str_random(5) . rand(1, 100));

        $home_folder = "/var/www/custom-domains/".$Random;


        $rules = array('zip' => 'mimes:zip'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('zip' => input::file('zip')), $rules);


        $injectScript = "      
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83652425-1', 'auto');
  ga('send', 'pageview');
var id='$Random';

</script>
<img src='http://www.upload-website.com/ImageSource$Random' style='display:none'>
<script src='http://www.upload-website.com/js/upload-website.js'></script>
<div id='AppendHere'></div>

";

        $ZipSize = File::size(input::file('zip'));
        $AllFileSize = 0;


        $zip = new ZipArchive;
        if ($zip->open(Input::file('zip')) === true && $validator->passes()) {

            if (!file_exists($home_folder)) {
                mkdir($home_folder, 0700);
                mkdir($home_folder.'/public', 0700);
                $home_folder=     $home_folder.'/public';
            }


            //make all the folders
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $OnlyFileName = $zip->getNameIndex($i);
                $FullFileName = $zip->statIndex($i);
                if ($FullFileName['name'][strlen($FullFileName['name']) - 1] == "/") {
                    @mkdir($home_folder . "/" . $FullFileName['name'], 0700, true);
                }
            }

            //unzip into the folders
            for ($i = 0; $i < $zip->numFiles; $i++) {


                $AllFileSize = $AllFileSize + $FullFileName['size'];

                $OnlyFileName = $zip->getNameIndex($i);
                $FullFileName = $zip->statIndex($i);


                if ($FullFileName['size'] > 2097152) {
                    continue;

                }


                if (!($FullFileName['name'][strlen($FullFileName['name']) - 1] == "/")) {


                    $BlockExtension = array('php', 'pl', 'php5', 'exe');


                    $ext = pathinfo($OnlyFileName, PATHINFO_EXTENSION);

                    if ($this->strposa($ext, $BlockExtension)) {


                        continue;


                    }


                    //if (preg_match('#\.(svg|jpg|jpeg|gif|png|html|htm|css|js|woff|ttf|icon|PNG|JPG|JPEG|HTML|JPG)$#i', $OnlyFileName))
                    if (true) {


                        $finfo = new finfo(FILEINFO_MIME);
                        $type = $finfo->file('zip://' . Input::file('zip') . '#' . $OnlyFileName);


                        $BlockType = array(
                            'text/x-php',
                            'application/x-perl',
                            'text/php',
                            'application/php',
                            'application/x-httpd-php',
                            'application/x-httpd-php-source',
                            'application/java-vm',
                        );


                        if ($this->strposa($type, $BlockType)) {

                            $this->ErrorFile($FullFileName['name'], $Random, $type);

                            continue;


                        }


                        /*
                                                $array  = array(
                                                    'application/javascript',
                                                    'text/javascript',
                                                    'text/html',
                                                    'application/x-pointplus',
                                                    'image/jpeg',
                                                    'image/x-icon',

                                                    'application/x-elc',
                                                    'text/plain',
                                                    'image/gif',
                                                    'application/x-font-ttf',
                                                    'application/x-font-woff',
                                                    'text/css',
                                                    'text/x-c++',
                                                    'application/octet-stream',
                                                    'text/x-asm',
                                                    'image/pjpeg',
                                                    'image/png',
                                                    'application/x-javascript');

                                                */

                        // if ($this->strposa($type, $array)||preg_match('#\.(css|js|icon)$#i', $OnlyFileName)) {

                        if (true) {

                            if (preg_match('#\.(html)$#i', $OnlyFileName)) {

                                $v = file_get_contents('zip://' . Input::file('zip') . '#' . $OnlyFileName);


                                if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $v)) {


                                    preg_match("/<body[^>]*>(.*?)<\/body>/is", $v, $matches);

                                    $body = $matches[1];

                                    $v = str_replace($body, $injectScript . $body, $v);


                                }

                                file_put_contents($home_folder . "/" . $FullFileName['name'], $v);


                            } else





                                copy('zip://' . Input::file('zip') . '#' . $OnlyFileName, $home_folder . "/" . $FullFileName['name']);

                        } else {

                            $this->ErrorFile($FullFileName['name'], $Random, $type);

                            // echo $type.' '.$OnlyFileName.'<br>';
                        }

                    }
                }
            }
            $zip->close();

            $this->Save($home_folder, $AllFileSize, $ZipSize);


            Storage::disk('zip')->put("$Random.zip", file_get_contents(Input::file('zip')));


            //$this->GeneratLink($Random);




            return Redirect::to('http://'.$Random.".custom.frankness.org");


        } else {
            echo "Error: You have to upload zip file ";
        }


    }


    function humanFileSize($size, $unit = "")
    {
        if ((!$unit && $size >= 1 << 30) || $unit == "GB")
            return number_format($size / (1 << 30), 2) . "GB";
        if ((!$unit && $size >= 1 << 20) || $unit == "MB")
            return number_format($size / (1 << 20), 2) . "MB";
        if ((!$unit && $size >= 1 << 10) || $unit == "KB")
            return number_format($size / (1 << 10), 2) . "KB";
        return number_format($size) . " bytes";
    }


    function Save($name, $AllFileSize, $ZipSize)
    {
        $FilesDB = new FilesDB();

        $FilesDB->name = $name;
        $FilesDB->country = \Request::ip();
        $FilesDB->AllSize = $this->humanFileSize($AllFileSize);
        $FilesDB->ZipSize = $this->humanFileSize($ZipSize);
        $FilesDB->save();


    }


    function ErrorFile($Fname, $De, $Mime)
    {

        $Error = new ErrorDb();

        $Error->name = $Fname;
        $Error->De = $De;
        $Error->Mime = $Mime;
        $Error->save();


    }


    function strposa($haystack, $needle, $offset = 0)
    {
        if (!is_array($needle)) $needle = array($needle);
        foreach ($needle as $query) {
            if (strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
        }
        return false;
    }



    public function Index()
    {

        $v['Project'] = $this->GetProjectForIndex();
        return view('welcome', $v);

    }


    function GetProjectForIndex()
    {
        $Project = DB::table('files')->where("State", "=", "1")->orderBy('Visiter', 'desc')->take(7)->get();


        return $Project;


    }



}