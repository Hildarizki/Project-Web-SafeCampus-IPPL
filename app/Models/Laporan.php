class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'kategori',
        'lokasi',
        'deskripsi',
        'anonim',
        'bukti',
        'status'
    ];
}