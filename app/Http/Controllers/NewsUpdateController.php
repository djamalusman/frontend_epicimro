<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsDetailModel;
use App\Models\NewsFileModel;
use App\Models\NewsMasterModel;
use App\Models\NewsTypeModel;
use Illuminate\Support\Facades\DB;
class NewsUpdateController extends Controller
{
    public function NewsList()
    {
        $data['title'] = 'News';

        $dataCount = NewsDetailModel::where('status', 1)->get();
        $data['Count'] = $dataCount->count();
        $data['category']= NewsMasterModel::all();

       return view('newslatest.newslist', $data);
    }

    public function NewsGrid()
    {
        $data['title'] = 'Browse Training By Category | Details';

        $dataCount = NewsDetailModel::where('status', 1)->get();
        $data['Count'] = $dataCount->count();
        $data['filter'] = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
       return view('newslatest.newsgrid', $data);
    }

    public function getContentNewsList (Request $request)
    {
        //dd($request->all());
        $filters = $request->all();
        //dd($filters);
        $query = DB::table('news_detail')
            ->leftJoin('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
            ->select(
                'news_detail.*',
                'm_news.nama as jenisBerita'

            );
        $whereData=$query->where('news_detail.status',1);


        // if (!empty($filters['jobtitle']) && is_array($filters['jobtitle'])) {
        //     $whereData->whereIn('news_detail.title', $filters['jobtitle']);

        // } elseif (!empty($filters['jobtitle']) && is_string($filters['jobtitle'])) {
        //     $whereData->where('news_detail.title', 'LIKE', '%' . $filters['jobtitle'] . '%');
        // }

        // if (!empty($filters['jenisberita']) && is_array($filters['jenisberita'])) {
        //     $whereData->whereIn('m_news.nama', $filters['jenisberita']);

        // } elseif (!empty($filters['jenisberita']) && is_string($filters['jenisberita'])) {
        //     $whereData->where('m_news.nama', 'LIKE', '%' . $filters['jenisberita'] . '%');
        // }

        // elseif (!empty($filters['jenisberita']) && is_string($filters['jenisberita'])) {
        //     $whereData->where('m_news.nama', 'LIKE', '%' . $filters['jenisberita'] . '%');
        // }

        if (!empty($filters['categorynews']) && is_array($filters['categorynews'])) {
            $whereData->whereIn('m_news.id', $filters['categorynews']);

        } elseif (!empty($filters['categorynews']) && is_string($filters['categorynews'])) {
            $whereData->where('m_news.id', 'LIKE', '%' . $filters['categorynews'] . '%');
        }


        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('news_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('news_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('news_detail.updated_at', 'desc'); // Default sort
        }

        $perPage = 6;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range
        $showing = view('partials.showing', [
            'from' => $from,
            'to' => $to,
            'total' => $data->total()
        ])->render();

        $sortAndView = view('partials.sort_and_view', [
            'sortBy' => $filters['sortBy'] ?? 'Newest Post'
        ])->render();

        return response()->json([
            'content' => view('partials.newslatest.content_news_list', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);
    }

    public function getContentNewsGrid (Request $request)
    {
        $filters = $request->all();
        //dd($filters);
        $query = DB::table('news_detail')
            ->leftJoin('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
            ->select(
                'news_detail.*',
                'm_news.nama as jenisBerita'

            );
        $whereData=$query->where('news_detail.status',1);





        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('news_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('news_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('news_detail.updated_at', 'desc'); // Default sort
        }

        $perPage = 3;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range
        $showing = view('partials.showing', [
            'from' => $from,
            'to' => $to,
            'total' => $data->total()
        ])->render();

        $sortAndView = view('partials.sort_and_view', [
            'sortBy' => $filters['sortBy'] ?? 'Newest Post'
        ])->render();

        return response()->json([
            'content' => view('partials.newslatest.content_news_grid', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);
    }

    public function previewJenisBerita(Request $request)
    {

        $filterNews = DB::table('m_news')->get();

        return response()->json($filterNews);
    }

    public function detailNews($id)
    {
        $data['title'] = 'Detail News';
        $data['listfiles']=  NewsFileModel::where('id_news_dtl',base64_decode($id))->get();
        $query = DB::table('news_detail')
        ->leftJoin('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
        ->select(
            'news_detail.*',
            'm_news.nama as jenisBerita',


        );
        $whereData=$query->where('news_detail.status',1);
        $data['getdataDetail']=$whereData->where('news_detail.id',base64_decode($id))->first();

        $anotherArticle = DB::table('news_detail')
            ->leftJoin('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
            ->select(
                'news_detail.*',
                'm_news.nama as jenisBerita',
                'm_news.nama as category'

            );

        $data['anotherarticle'] = $anotherArticle->where('news_detail.id', '!=', base64_decode($id))->get();

        return view('newslatest.detailnews', $data);
    }
}
