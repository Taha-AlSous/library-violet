<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Models\Book;


class WaitingListController extends Controller
{
//     public function store(Request $request)
// {
//     $request->validate([
//         'book_id' => 'required|exists:books,id'
//     ]);

//         $customerId =  Auth::user()->customer->id;        

//     // تحقق إذا موجود مسبقاً
//     $exists = WaitingList::where('customer_id', $customerId)
//         ->where('book_id', $request->book_id)
//         ->exists();

//     if ($exists) {
//         return response()->json([
//             'message' => 'أنت موجود مسبقاً في قائمة الانتظار'
//         ], 400);
//     }

//     WaitingList::create(attributes: [
//         'customer_id' => $customerId,
//         'book_id' => $request->book_id,
//     ]);

//     return response()->json([
//         'message' => 'تمت الإضافة إلى قائمة الانتظار'
//     ], 201);
// }





public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $customer =  Auth::user()->customer;        
        $book = Book::findOrFail($request->book_id);

        if ($book->stock > 0) {
            return response()->json([
                'message' => 'الكتاب متوفر حالياً ولا يمكن إضافته إلى قائمة الانتظار'
            ], 400);
        }

        $exists = WaitingList::where('customer_id', $customer->id)
            ->where('book_id', $book->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'أنت موجود مسبقاً في قائمة الانتظار'
            ], 400);
        }

        WaitingList::create([
            'customer_id' => $customer->id,
            'book_id' => $book->id,
        ]);

        return response()->json([
            'message' => 'تمت إضافتك إلى قائمة الانتظار بنجاح'
        ], 201);
    }
}