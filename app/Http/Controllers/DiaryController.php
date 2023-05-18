<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use Datetime;

class DiaryController extends Controller
{

    /**
     * 一覧
     */
    public function index(Request $request)
    {

        $diaries_total = Diary::count();
        $per_page = $request->input('per_page')? $request->input('per_page'): 5;
        $max_page = ceil($diaries_total / $per_page);
        $select_page = $request->input('select_page')? $request->input('select_page'): 1;
        if($max_page <= 0){
            $max_page = 1;
        }
        if($select_page > $max_page){
            $select_page = $max_page;
        }

        $offset = ($per_page * $select_page) - $per_page;

        $diaries = new Diary();
        $diaries = $diaries->orderByDesc('id');
        $diaries = $diaries->offset($offset);
        $diaries = $diaries->limit($per_page);
        $diaries = $diaries->get();

        $view_args = [];
        $view_args['diaries'] = $diaries;
        $view_args['page_nation']['select_page'] = $select_page;
        $view_args['page_nation']['max_page'] = $max_page;
        return view('diary.index', $view_args);
    }

    /**
     * 詳細
     */
    public function detail($id)
    {
        $diary = new Diary();
        $diary = $diary->where('id', $id);
        $diary = $diary->first();

        $view_args = [];
        $view_args['diary'] = $diary;
        return response()->json([
            'modal' => view('diary.modal.detail', $view_args)->render()
        ]);
    }

    /**
     * 作成
     */
    public function create()
    {
        return view('diary.create');
    }

    /**
     * 登録
     */
    public function post(Request $request)
    {
        $request->validate([
            'diary_image' => 'required',
            'diary_content' => 'required'
        ]);
        
        $uploaded_image = $request->file('diary_image');
        $original_image_name = $uploaded_image->getClientOriginalName();
        $original_image_ext = $uploaded_image->getClientOriginalExtension();
        $generated_file_name = uniqid('', true).'.'.$original_image_ext;

        $uploaded_image->storeAs('public/images/diary_images', $generated_file_name);

        $diary = [];
        $diary['content'] = $request->input('diary_content');
        $diary['local_image_path'] = 'storage/images/diary_images/'.$generated_file_name;
        $diary['local_small_image_path'] = 'storage/images/diary_images/'.$generated_file_name;
        $diary['original_image_name'] = $original_image_name.'.'.$original_image_ext;
        $diary['created_at'] = new DateTime();
        $diary['updated_at'] = new DateTime();

        $diaryModel = new Diary();
        $diaryModel->insert($diary);

        return redirect('/');
    }

    /**
     * 削除
     */
    public function delete($id)
    {
        $diary = new Diary();
        $diary = $diary->where('id', $id);
        $diary = $diary->delete();
        return true;
    }
}
