<?php

namespace App\Traits;

use Illuminate\Foundation\Console\KeyGenerateCommand;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait UploadTrait
{
    /**
     * @var S3Client
     */
    protected $customBucket;
    /**
     * @var S3Client
     */
    protected $globalBucket;
    /**
     * @var AwsS3Adapter
     */
    protected $bucketAdapter;
    /**
     * @var Filesystem
     */
    protected $fileSystem;
    /**
     * @var Storage
     */
    protected $localDisk;
    /**
     * @var array
     */
    protected $localPermissions;
    /**
     * @var Config
     */
    protected $localConfig;
    /**
     * @var UploadConfig
     */
    protected $instituicaoUploadConfig;
    /**
     * @var string
     */
    protected $option;
    /**
     * @var string
     */
    protected $finalURL;
    /**
     * @var string
     */
    protected $diskS3 = 's3';
    /**
     * @var string
     */
    protected $diskLocal = 'local';

    // public function startConfig()
    // {
    //     $this->tenant = (new TenantManager())->getTenant();
    //     $this->instituicao = $this->tenant;
    //     if ($this->instituicao != null) {
    //         $this->instituicaoUploadConfig = UploadConfig::where([['instituicao_id', '=', $this->instituicao->id], ['status', '=', 1]])->first();
    //     }
    //     $this->localPermissions = [
    //         'file' => [
    //             'public' => 0744,
    //             'private' => 0700
    //         ],
    //         'dir' => [
    //             'public' => 0755,
    //             'private' => 0700,
    //         ]
    //     ];
    //     $this->localConfig = new Config(['visibility' => 'public']);
    //     $this->prepareUpload();
    // }

    /**
     * Initiate the client custom S3 Bucket
     *
     * @return void
     */
    // protected function startCustomBucket()
    // {
    //     $key = $this->instituicaoUploadConfig->key;
    //     $secret = $this->instituicaoUploadConfig->secret;
    //     $region = $this->instituicaoUploadConfig->region;
    //     $bucket = $this->instituicaoUploadConfig->bucket;
    //     $this->customBucket = new S3Client([
    //         'credentials' => [
    //             'key' => $key,
    //             'secret' => $secret
    //         ],
    //         'region' => $region,
    //         'version' => 'latest'
    //     ]);
    //     $this->bucketAdapter = new AwsS3Adapter($this->customBucket, $bucket);
    //     $this->fileSystem = new Filesystem($this->bucketAdapter, ['visibility' => 'public']);
    //     $this->option = $this->diskS3;
    //     $this->finalURL = "https://{$bucket}.s3.{$region}.amazonaws.com/";
    // }

    /**
     * Initiate the global custom S3 Bucket
     *
     * @return void
     */
    // protected function startGlobalBucket()
    // {
    //     $this->globalBucket = new S3Client([
    //         'credentials' => [
    //             'key' => getenv('AWS_ACCESS_KEY_ID'),
    //             'secret' => getenv('AWS_SECRET_ACCESS_KEY')
    //         ],
    //         'region' => getenv('AWS_DEFAULT_REGION'),
    //         'version' => 'latest'
    //     ]);
    //     $this->bucketAdapter = new AwsS3Adapter($this->globalBucket, getenv('AWS_BUCKET'));
    //     $this->fileSystem = new Filesystem($this->bucketAdapter, ['visibility' => 'public']);
    //     $this->option = $this->diskS3;
    //     $this->finalURL = "https://" . getenv('AWS_BUCKET') . ".s3." . getenv('AWS_DEFAULT_REGION') . ".amazonaws.com/";
    // }

    /**
     * Initiate the local disk Storage
     *
     * @return void
     */
    // protected function startLocalDisk()
    // {
    //     $this->localDisk = public_path() . '/uploads';
    //     $this->fileSystem = new Local($this->localDisk, 0);
    //     $this->option = $this->diskLocal;
    //     $this->finalURL = "";
    // }

    /**
     * Verifies which upload method will be used
     */
    // protected function prepareUpload()
    // {
    //     if ($this->instituicaoUploadConfig != null) {
    //         $this->startCustomBucket();
    //     } else if (getenv('AWS_ACCESS_KEY_ID') !== false) {
    //         $this->startGlobalBucket();
    //     } else {
    //         $this->startLocalDisk();
    //     }
    // }

    protected function getDiskS3()
    {
        return $this->diskS3;
    }

    protected function getDiskLocal()
    {
        return $this->diskLocal;
    }

    protected function checkDirectory($fullPath)
    {
        if ($this->option == $this->getDiskS3()) {
            if (!$this->fileSystem->has($fullPath)) {
                $this->fileSystem->createDir($fullPath);
            }
        } else if ($this->option == $this->getDiskLocal()) {
            if (!$this->fileSystem->has($fullPath)) {
                $this->fileSystem->createDir($fullPath, $this->localConfig);
            }
        }
    }

    /**
     * Upload image     
     */
    protected function putFile($uploadFile, $fullFilename, $newFileName)
    {
        $return = array();
        if ($this->option == $this->getDiskS3()) {
            if (!$this->fileSystem->put($fullFilename, file_get_contents($uploadFile), ['visibility' => 'public'])) {
                $return['type'] = 'danger';
                $return['message'] = 'Ocorreu um erro ao gravar o arquivo';
            } else {
                $return['type'] = 'success';
                $return['message'] = $this->finalURL . $fullFilename;
            }
        } else if ($this->option == $this->getDiskLocal()) {
            if (!$this->fileSystem->write($fullFilename, file_get_contents($uploadFile), $this->localConfig)) {
                $return['type'] = 'danger';
                $return['message'] = 'Ocorreu um erro ao gravar o arquivo';
            } else {
                $return['type'] = 'success';
                $return['message'] = $this->finalURL . $fullFilename;
            }
        }
        $return['fileName'] = $newFileName;
        return $return;
    }

    public function putFileResize($uploadFile, $fullFilename, $fullPath, $newFileName)
    {
        $return = array();
        if ($this->option == $this->getDiskS3()) {
            if (!$this->fileSystem->put($fullFilename, $uploadFile->response()->content(), ['visibility' => 'public'])) {
                $return['type'] = 'danger';
                $return['message'] = 'Ocorreu um erro ao gravar o arquivo';
            } else {
                $return['type'] = 'success';
                $return['message'] = $this->finalURL . $fullFilename;
            }
        } else if ($this->option == $this->getDiskLocal()) {
            if (!$this->fileSystem->write($fullFilename, $uploadFile->response()->content(), $this->localConfig)) {
                $return['type'] = 'danger';
                $return['message'] = 'Ocorreu um erro ao gravar o arquivo';
            } else {
                $return['type'] = 'success';
                $return['message'] = $this->finalURL . $fullFilename;
            }
        }
        $return['fileName'] = $newFileName;
        return $return;
    }

    /**
     * Method delete file
     *     
     * @param string $fileName
     * @return mix
     */
    public function delete($fileName)
    {
        if (Storage::exists($fileName)) {
            return Storage::delete($fileName);
        }

        return false;
    }

    /**
     * Method to upload converted file (commonly used with CloudConvertAPI)
     */
    public function uploadConvertedFile($file, $fileName, $path, $fileExtension)
    {
        $this->startConfig();
        $this->prepareUpload();
        if ($this->instituicao != null) {
            $path = $this->instituicao->id . "/" . $path;
        }
        if (!empty($file)) {
            $file = stream_get_meta_data($file);
            $file = (object)$file;
            if ($file) {
                $newFileName = md5($fileName . date("Y-m-d H:i:s") . time()) . '.' . $fileExtension;
                $fullFilename = $path . '/' . $newFileName;
                $this->checkDirectory($path);
                $return = $this->putFile($file->uri, $fullFilename, $path, $newFileName);
            } else {
                $return['type'] = 'danger';
                $return['message'] = 'Ocorreu um erro ao gravar o arquivo';
            }
        } else {
            $return['type'] = 'danger';
            $return['message'] = 'Ocorreu um erro ao gravar o arquivo';
        }
        return $return;
    }

    /**
     * Return image
     *
     * @param string $img
     * @param integer $width
     * @param integer $height
     * @return mix
     */
    public function get($img, int $width = null, int $height = null)
    {
        $url = Storage::get($img);
        
        if (!$width && !$height) {
            $image = Image::cache(function ($image) use ($url) {
                $image->make($url);
            });
        } else {
            $image = Image::cache(function ($image) use ($url, $width, $height) {
                if ($width && $height) {
                    $image->make($url)->fit($width, $height);
                } else {
                    $image->make($url)
                        ->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                }
            });
        }

        if (isset($image)) {
            return Response::make($image, 200, ['Content-Type' => 'image'])
                ->setMaxAge(864000)
                ->setPublic();
        }

        return false;
    }

    /**
     * Upload file
     *
     * @param  \Illuminate\Http\Request $fieldName     
     * @param string $path
     * @return void
     */
    public function put($uploadFile, $path)
    {
        if (!empty($uploadFile)) {
            $uploadFile = (object)$uploadFile;
            if ($uploadFile) {
                $pathName = $this->pathName($path);
                $newFileName = md5(uniqid(now())) . strrchr($uploadFile->getClientOriginalName(), '.');
                // $uploadFile = Image::make($uploadFile)->orientate();
                // $uploadFile->resize(1000, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     // $constraint->upsize();
                // });
                return Storage::put($pathName, $uploadFile, 'public');                
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Method to resize and upload file to storage
     */
    public function resize($file)
    {
        $img = Image::make($file)->orientate();
        $newImg = $img->resize(1000, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $newImg;
    }

    /**
     * Method used to validade the correct asset path
     * @param $origin - The File URL parameter
     * @param $oldPath - The old folder where the file was stored on local disk
     *                   or null if the upload folder is just 'uploads'
     * @return string - URL formatted or empty string
     */
    public function validateAsset($origin, $oldPath = null)
    {
        if ($origin != "") {
            if (strpos($origin, "amazonaws") === false) {
                if ($oldPath != null) {
                    if (strpos($origin, $oldPath) === false) {
                        return $this->checkFileExists($origin, "{$oldPath}");
                    } else {
                        return $this->checkFileExists($origin);
                    }
                } else {
                    return $this->checkFileExists($origin);
                }
            } else {
                return $origin;
            }
        } else {
            return "";
        }
    }

    /**
     * @param $path - File path for local storage
     * @return bool - Return if file exists
     */
    protected function checkFileExists($file, $path = null)
    {
        $localPath = public_path("uploads/");
        if ($path == null) {
            if (file_exists($localPath . $file)) {
                return asset("uploads/{$file}");
            } else {
                $directories = explode("/", $file);
                $file = end($directories);
                for ($i = 0; $i < count($directories) - 1; $i++) {
                    $path .= $directories[$i] . "/";
                }
                $path = substr($path, 0, -1);
                $newPath = $this->returnCorrectFolder($path);
                $newFile = $newPath . "/" . $file;
                if (file_exists($localPath . $newFile)) {
                    return asset("uploads/{$newFile}");
                }
            }
        } else {
            $newFile = $path . "/" . $file;
            if (file_exists($localPath . $newFile)) {
                return asset("uploads/{$newFile}");
            } else {
                $directories = explode("/", $file);
                $file = end($directories);
                for ($i = 0; $i < count($directories) - 1; $i++) {
                    $path .= $directories[$i] . "/";
                }
                $path = substr($path, 0, -1);
                $newPath = $this->returnCorrectFolder($path);
                $newFile = $newPath . "/" . $file;
                if (file_exists($localPath . $newFile)) {
                    return asset("uploads/{$newFile}");
                }
            }
            return asset("uploads/{$file}");
        }
    }

    /**
     * Generate global path
     *
     * @param string $path
     * @return mix
     */
    protected function pathName($path)
    {
        // return "/uploads/" . auth()->user()->uuid . "/" . $path;

        return "/uploads/" . 'd6f9d6d9-ff17-4e0c-a214-f92bec94e5e7' . "/" . $path;
    }
}
