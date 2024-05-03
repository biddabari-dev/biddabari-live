<?php

namespace App\Models\Backend\PdfManagement;

use App\Models\Backend\PdfManagement\PdfStoreCategory;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PdfStore extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'pdf_store_category_id',
        'title',
        'preview_image',
        'file_external_link',
        'file_url',
        'file_size',
        'file_type',
        'file_extension',
        'total_page',
        'slug',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'pdf_stores';

    protected static $file, $fileName, $fileDirectory, $fileSize = null, $fileType = null, $fileExtension = null, $pdfStore, $fileUrl;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        parent::deleting(function ($pdfStore){
            if (file_exists($pdfStore->image))
            {
                unlink($pdfStore->image);
            }
        });
    }

    public static function saveOrUpdatePdfStore($request, $id = null)
    {
        if (isset($id))
        {
            self::$pdfStore = static::find($id);
        } else {
            self::$pdfStore = new PdfStore();
        }
        self::$file = $request->file('file');
        if (self::$file)
        {
            if (isset($id))
            {
                if (file_exists(self::$pdfStore->file_url))
                {
                    unlink(self::$pdfStore->file_url);
                }
            }
            self::$fileName = 'pdf-store-'.rand(10, 999999).time().'.'.self::$file->getClientOriginalExtension();
            self::$fileDirectory = 'backend/assets/uploaded-files/pdf-management/pdf-store/';
            self::$file->move(self::$fileDirectory, self::$fileName);
            self::$fileUrl = self::$fileDirectory.self::$fileName;
//            self::$fileSize = self::$file->getSize();
            self::$fileSize = $_FILES['file']['size'];
            self::$fileType = self::$file->getClientMimeType();
            self::$fileExtension = self::$file->getClientOriginalExtension();
        } else {
            if (isset($id))
            {
                self::$fileUrl = self::$pdfStore->file_url;
            } else {
                self::$fileUrl = null;
            }
        }
        self::$pdfStore->pdf_store_category_id = $request->pdf_store_category_id;
        self::$pdfStore->title = $request->title;
        self::$pdfStore->preview_image = imageUpload($request->file('preview_image'), 'pdf-management/pdf-store/preview-image/', 'preview-', 300, 300, isset($id) ? self::$pdfStore->preview_image : null);
        self::$pdfStore->file_external_link = $request->file_external_link;
        self::$pdfStore->file_url = self::$fileUrl;
        self::$pdfStore->file_size = self::$fileSize;
        self::$pdfStore->file_type = self::$fileType;
        self::$pdfStore->file_extension = self::$fileExtension;
        self::$pdfStore->total_page = $request->total_page;
        self::$pdfStore->slug = str_replace(' ', '-', $request->title);
        self::$pdfStore->status = $request->status == 'on' ? 1 : 0;
        self::$pdfStore->save();
    }

    public function pdfStoreCategory()
    {
        return $this->belongsTo(PdfStoreCategory::class);
    }
}
