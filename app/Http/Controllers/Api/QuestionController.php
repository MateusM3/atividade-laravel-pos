<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionResource;
use App\Model\Question;
use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function index()
    {
        return QuestionResource::collection(Question::latest()->get());
    }

    public function store(QuestionRequest $request)
    {
        Question::create(array(
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ));

        return response('Criado', Response::HTTP_CREATED);
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $question->update(array(
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ));

        return response('Atualizado', Response::HTTP_ACCEPTED);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

}
