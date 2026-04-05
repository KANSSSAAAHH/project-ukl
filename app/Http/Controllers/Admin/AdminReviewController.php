<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_review';
    public $timestamps    = false;

    protected $fillable = [
        'id_user',
        'id_produk',
        'rating',
        'komentar',
    ];

    // Relasi ke users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    // GET /admin/review
    public function index()
    {
        $reviews = Review::with(['user', 'produk'])->latest('id_review')->get();
        return view('admin.review.index', compact('reviews'));
    }

    // GET /admin/review/create
    public function create()
    {
        $users  = User::all();
        $produk = Produk::where('status', 'aktif')->get();
        return view('admin.review.create', compact('users', 'produk'));
    }

    // POST /admin/review
    public function store(Request $request)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id_user',
            'id_produk' => 'required|exists:produk,id_produk',
            'rating'    => 'required|integer|min:1|max:5',
            'komentar'  => 'required|string',
        ]);

        Review::create($request->all());

        return redirect()->route('admin.review.index')
                         ->with('success', 'Review berhasil ditambahkan!');
    }

    // GET /admin/review/{id}/edit
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $users  = User::all();
        $produk = Produk::all();
        return view('admin.review.edit', compact('review', 'users', 'produk'));
    }

    // PUT /admin/review/{id}
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'id_user'   => 'required|exists:users,id_user',
            'id_produk' => 'required|exists:produk,id_produk',
            'rating'    => 'required|integer|min:1|max:5',
            'komentar'  => 'required|string',
        ]);

        $review->update($request->all());

        return redirect()->route('admin.review.index')
                         ->with('success', 'Review berhasil diperbarui!');
    }

    // DELETE /admin/review/{id}
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.review.index')
                         ->with('success', 'Review berhasil dihapus!');
    }
}