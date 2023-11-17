<?php namespace Pensoft\Media\Components;

use Cms\Classes\ComponentBase;
use Pensoft\Media\Models\Galleries as GalleriesModel;

/**
 * Galleries Component
 *
 * This component handles gallery operations such as displaying gallery details
 * and providing a download functionality for gallery images as a zip archive.
 */
class Galleries extends ComponentBase
{
    /** @var GalleriesModel The loaded gallery record */
    public $record;

    /** @var int Maximum allowed size for the zip file in bytes */
    const MAX_ZIP_SIZE = 500000000;

    /**
     * Component details
     *
     * @return array The name and description of the component
     */
    public function componentDetails()
    {
        return [
            'name' => 'Gallery Component',
            'description' => 'Displays the gallery and gallery details'
        ];
    }

    /**
     * Define component properties
     *
     * @return array Component properties definitions
     */
    public function defineProperties()
    {
        return [
            'id' => [
                'title' => 'id',
                'description' => 'The id of the record',
                'default' => '{{ :id }}',
                'type' => 'string'
            ]
        ];
    }

    /**
     * Execute when the component runs. Loads the gallery record.
     */
    public function onRun()
    {
        $this->record = $this->loadRecord();
        $this->page['gallery'] = $this->record;
        $this->page[$this->alias . 'Gallery'] = $this->record;

    }

    /**
     * Handle download request. Creates a zip archive and initiates the download.
     *
     * @return mixed Download response or error message
     */
    public function onDownload()
    {
        $zipFile = $this->createZipArchive();
        return $this->prepareDownloadResponse($zipFile);
    }

    /**
     * Create a zip archive containing gallery images.
     *
     * @return string|null The path to the created zip file or null on error
     */
    protected function createZipArchive()
    {
        $zipFileName = $this->getTemporaryZipFileName();
        $zip = $this->initializeZipArchive($zipFileName);

        if (!$zip) {
            return null;
        }

        $images = $this->getImagePaths();
        $this->addImagesToZip($zip, $images);
        $zip->close();

        return $zipFileName;
    }

    /**
     * Generate the temporary zip file name based on gallery name.
     *
     * @return string Path to the temporary zip file
     */
    protected function getTemporaryZipFileName()
    {
        $record = $this->loadRecord();
        $galleryName = $this->sanitizeFileName($record->name);
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . $galleryName . '.zip';
    }

    /**
     * Initialize a new or existing zip archive.
     *
     * @param string $zipFileName The path to the zip file
     * @return \ZipArchive|null Initialized zip archive or null on error
     */
    protected function initializeZipArchive($zipFileName)
    {
        $zip = new \ZipArchive;

        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            return null;
        }

        return $zip;
    }

    /**
     * Add images to the zip archive.
     *
     * @param \ZipArchive|string $zip The zip archive instance
     * @param array $images List of image paths to be added to the zip
     */
    protected function addImagesToZip($zip, $images)
    {
        if (empty($images)) {
            $zip->close();
            unlink($zip);
            return;
        }

        foreach ($images as $image) {
            if (file_exists($image)) {
                $zip->addFile($image, basename($image));
            }
        }
    }

    /**
     * Prepare the response for zip download.
     *
     * @param string $zipFile Path to the zip file
     * @return mixed Download response or error message
     */
    protected function prepareDownloadResponse($zipFile)
    {
        if (file_exists($zipFile) && filesize($zipFile) < self::MAX_ZIP_SIZE) {
            return \Response::download($zipFile)->deleteFileAfterSend(true);
        }
        return "Error downloading or file size exceeded";
    }

    /**
     * Get the local paths of the images in the gallery.
     *
     * @return array List of local image paths
     */
    protected function getImagePaths()
    {
        $record = $this->loadRecord();
        $images = [];

        if ($record && isset($record->images)) {
            foreach ($record->images as $image) {
                $localPath = $image->getLocalPath();
                if ($localPath) {
                    $images[] = $localPath;
                }
            }
        }

        return $images;
    }

    /**
     * Sanitize the provided filename.
     *
     * @param string $filename The original filename
     * @return string Sanitized filename
     */
    protected function sanitizeFileName($filename)
    {
        return preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
    }

    /**
     * Load the gallery record based on the provided ID.
     *
     * @return GalleriesModel|null The gallery record or null if not found
     */
    protected function loadRecord()
    {
        $galleryId = $this->property('id');
        return GalleriesModel::find($galleryId);
    }

}
