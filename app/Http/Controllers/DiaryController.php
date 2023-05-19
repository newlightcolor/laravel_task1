<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
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
     * 編集
     */
    public function edit(Request $request)
    {

        $request->validate([
            'id' => 'required|numeric',
        ]);

        $diary = Diary::where('id', $request->input('id'))->first();
        
        $view_args['diary'] = $diary;
        return view('diary.edit', $view_args);
    }

    /**
     * 登録
     */
    public function post(Request $request)
    {
        $request->validate([
            'diary_image' => 'required|image',
            'diary_content' => 'required'
        ]);
        
        $stored_file_alias = $this->store_file($request, 'diary_image', 'images/diary_images/');

        $diary = [];
        $diary['content'] = $request->input('diary_content');
        $diary['local_image_path'] = $stored_file_alias;
        $diary['local_small_image_path'] = $stored_file_alias;
        $diary['original_image_name'] = $request->input('diary_image');
        $diary['created_at'] = new DateTime();
        $diary['updated_at'] = new DateTime();

        $diaryModel = new Diary();
        $diaryModel->insert($diary);

        return redirect('/');
    }

    /**
     * 更新
     */
    public function put(Request $request)
    {

        $request->validate([
            'id' => 'required|numeric',
            'diary_image' => 'required|image',
            'diary_content' => 'required'
        ]);

        $old_diary = Diary::where('id', $request->input('id'))->first();
        if(!$old_diary){
            return redirect('/');
        }
        
        $stored_file_alias = $this->store_file($request, 'diary_image', 'images/diary_images/');

        $diary = [];
        $diary['content'] = $request->input('diary_content');
        $diary['local_image_path'] = $stored_file_alias;
        $diary['local_small_image_path'] = $stored_file_alias;
        $diary['original_image_name'] = $request->input('diary_image');
        $diary['created_at'] = new DateTime();
        $diary['updated_at'] = new DateTime();

        $diaryModel = new Diary();
        $diaryModel = $diaryModel->where('id', $request->input('id'));
        $diaryModel->update($diary);

        //古い画像の削除
        if($old_diary->local_image_path && strpos($old_diary->local_image_path, '/default/') === FALSE){
            $old_image_name = explode('/', $old_diary->local_image_path);
            $old_image_name = $old_image_name[array_key_last($old_image_name)];
            Storage::delete('public/images/diary_images/'.$old_image_name);
        }

        return redirect('/');
    }

    /**
     * 削除
     */
    public function delete($id)
    {

        $diary = new Diary();
        $diary = $diary->where('id', $id);

        $delete_diary = $diary->first();
        $diary->delete();

        //古い画像の削除
        if($delete_diary->local_image_path && strpos($delete_diary->local_image_path, '/default/') === FALSE){
            $old_image_name = explode('/', $delete_diary->local_image_path);
            $old_image_name = $old_image_name[array_key_last($old_image_name)];
            Storage::delete('public/images/diary_images/'.$old_image_name);
        }
        
        return true;
    }

    /**
     * ファイル保存
     */
    private function store_file($request, $file_name = NULL, $store_dir = NULL){

        $uploaded_file = $request->file($file_name);
        $original_file_name = $uploaded_file->getClientOriginalName();
        $original_file_ext = $uploaded_file->getClientOriginalExtension();
        $generated_file_name = uniqid('', true).'.'.$original_file_ext;

        $uploaded_file->storeAs('public/'.$store_dir, $generated_file_name);
        
        $file_alias_path = 'storage/'.$store_dir.$generated_file_name;
        return $file_alias_path;
    }
}
