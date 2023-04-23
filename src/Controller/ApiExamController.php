<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Exams;
use App\Entity\Questions;
use App\Entity\ExamUser;
use App\Repository\ExamsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiExamController extends AbstractController
{

    /**
     * @Route("/api/exam/store", name="apiExamStore", methods="POST")
     */
    public function apiExamStore(Request $request,ManagerRegistry $doctrine)
    {
        $this->authenticateAdmin();
        $em = $doctrine->getManager();
        $exam = new Exams();
        $exam->setName($request->request->get('examName'));
        $exam->setTs(new \DateTime());
        $em->persist($exam);
        $em->flush();
        return $this->redirectToRoute('AdminExam');
    }
    /**
     * @Route("/api/exam/update/{id}", name="apiExamUpdate", methods="POST")
     */
    public function apiExamUpdate(ManagerRegistry $doctrine, Request $request,$id){
        $exam = $doctrine->getRepository(Exams::class)->findOneBy(['id'=>$id]);
        if (!$exam) {
            throw $this->createNotFoundException(
                'No exam found for id '.$id
            );
        }
        $exam->setName($request->request->get('examName'));
        $entityManager->persist();
        $entityManager->flush();
    }
    /**
     * @Route("/api/exam/delete/{id}", name="apiExamDelete", methods="GET")
     */
    public function apiExamDelete(ManagerRegistry $doctrine,$id){
        $exam = $doctrine->getRepository(Exams::class)->findOneBy(['id'=>$id]);
        if (!$exam) {
            throw $this->createNotFoundException(
                'No exam found for id '.$id
            );
        }
        $entityManager->remove($exam);
        $entityManager->flush();
    }
    /**
     * @Route("/api/exam/save/{id}", name="apiExamSave", methods="GET")
     */

     //TODO All refactor
    public function saveSettings(Request $request, ManagerRegistry $entityManager, $id){
        $settingsFromDatabase = $doctrine->getRepository(Exams::class)->findOneBy(['id'=>$id]);
        //Setting for random display question
        if ($request->set_random == 1 && !isset($request->random)){
            $settingsToDatabase->random = null;
        }
        if (isset($request->random)){
            $settingsToDatabase->random = 1;
        }
        //Setting for progressive display question
        if ($request->set_progressive == 1 && !isset($request->progressive)){
            $settingsToDatabase->progressive = 0;
        }
        if (isset($request->progressive)){
            $settingsToDatabase->progressive = 1;
        }
        //Setting for show rules before exam
        if ($request->set_rules == 1 && !isset($request->rules_page)){
            $settingsToDatabase->rules_page = 0;
            $settingsToDatabase->rules_page_text = null;
        }
        if (isset($request->rules_page)){
            $settingsToDatabase->rules_page = 1;
            $settingsToDatabase->rules_page_text = $request->rules;
        }
        //Settings for exam time and amount question in exam
        if ($settingsFromDatabase[0]->time != $request->time){
            $settingsToDatabase->time = $request->time;
        }
        if ($settingsFromDatabase[0]->xOFy != $request->xOFy){
            $settingsToDatabase->xOFy = $request->xOFy;
        }
        $settingsToDatabase->save();
        return back();
    }
    /**
     * @Route("/api/exam/saveUser/{id}", name="apiExamSaveUser", methods="GET")
     */

    public function saveUsers(Request $request, ManagerRegistry $entityManager, $id){
        $settingsFromDatabase = $doctrine->getRepository(ExamUser::class)->findOneBy(['id'=>$id]);
        $counterBack = 0;
        if ($request->user != null) {
            foreach ($request->user as $i => $item) {
                if ($item['set'] == 1 && !isset($item['check'])) {
                    ExamUser::where('user_id', $i)->where('exam_id', $request->testName)->first()->delete();
                }

                if (isset($item['check'])) {
                    if ($item['set'] == 0 && $item['check'] == 'on') {
                        $counter = 0;
                        foreach ($UserBelongs as $user) {
                            $counter = 0;
                            if ($user->user_id == $i) {
                                $counter = 1;
                            }
                        }
                        if ($counter == 0) {
                            $belong = new ExamUser();
                            $belong->user_id = $i;
                            $belong->exam_id = $request->testName;
                            $belong->save();
                            $counterBack++;
                        }
                    }
                }
            }
        }


        if ($request->group != null) {
            foreach ($request->group as $i => $item) {
                if ($item['set'] == 1 && !isset($item['check'])) {
                    ExamUser::where('exam_id', $request->testName)->where('group_id', $i)->first()->delete();
                }

                if (isset($item['check'])) {
                    if ($item['set'] == 0 && $item['check'] == 'on') {
                        $counter = 0;
                        foreach ($UserBelongs as $user) {
                            $counter = 0;
                            if ($user->group_id == $i) {
                                $counter = 1;
                            }
                        }
                        if ($counter == 0) {
                            $belong = new ExamUser();
                            $belong->exam_id = $request->testName;
                            $belong->group_id = $i;
                            $belong->save();
                            $counterBack++;
                        }
                    }
                }
            }
        }
        return back()->with('add',$counterBack);
    }
    /**
     * @Route("/api/exam/question/store/{id}", name="apiExamQuestionSingleStore", methods="GET")
     */    
    public function store(Request $request, ManagerRegistry $entityManager,$id)
    {
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;

        $question = new Question;
        $question->exam_id = $request->exam_id;
        $question->question_number = $question_number;
        $question->question_title = $request->question_title;
        $question->question_type = $request->question_type;
        $question->answer_correct = $request->answer_correct;
        $question->save();
        $answerCounter = 1;
        foreach ($request->answer as $item){
            $answer = new Answer;
            $question_id = Question::select('id')->where('exam_id','=',$request->exam_id)->where('question_number','=',$question_number)->get();
            $answer->question_id = $question_id['0']->id;
            $answer->answer = $item['answer'];
            $answer->answer_id = $answerCounter;
            $answer->save();
            $answerCounter++;

        }
        return back();
    }
    /**
     * @Route("/api/exam/question/storeOpen/{id}", name="apiExamQuestionOpenStore", methods="GET")
     */   
    public function storeOpen(Request $request,$id)
    {
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;
        $examId = $entityManager->getRepository(Exams::class)->findByOne(['id'=>$id])->getId();
        $question = new Question();

        $question->setExamIdFk($exam_id);
        $question->setQuestionNumber($question_number);
        $question->setQuestionTitle($request->question_title);
        $question->setquestionType($request->question_type);
        $question->setAnswerCorrect(null);
        $question->persist();
        $question->flush();
    }
    /**
     * @Route("/api/exam/question/storeMultiCheck/{id}", name="apiExamQuestionMultiStore", methods="GET")
     */   
    public function storeMultiCheck(Request $request){
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;


        $question = new Question();
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;
        $examId = $entityManager->getRepository(Exams::class)->findByOne(['id'=>$id])->getId();
        $question->setExamId($examId);
        $question->setQuestionNumber($question_number);
        $question->setQuestionTitle($request->question_title);
        $question->setQuestionType($request->question_type);
        $question->setAnswerCorrect_multi(1);
        $question->persist();
        $question->flush();

        $answerCounter = 1;

        foreach ($request->answer as $item){
            $answer = new Answer;
            $answer->setQuestionId = $question->getId;
            $answer->setAnswer($item['answer']);
            $answer->setAnswerId($answerCounter);
            $answer->persist();
            $answer->flush();

            $answerCounter++;
        }
        foreach ($request->answer_correct as $i => $item){
            $answerCorrect = new MultiAnswerCorrect();
            $answerCorrect->exam_id=$request->exam_id;
            $answerCorrect->question_id = $question->id;
            $answerCorrect->answer = $item['check'];
            $answerCorrect->persist();
            $answerCorrect->flush();
        }


        return back();
    }
    /**
     * @Route("/api/exam/question/update/{id}", name="apiExamSave", methods="GET")
     */   
    public function update(Request $request, $id)
    {

        $question = Question::where('id', '=',$request->question_id)->first();
        $question->exam_id = $id;
        $question->question_number = $request->question_number;
        $question->question_title = $request->question_title;

        if ($request->question_type == 1){
            $question->answer_correct = $request->answer_correct;
        }
        if ($request->question_type == 3){
                foreach ($request->answer_correct as $i => $item){
                    if ($item['set'] == 1 && !isset($item['check'])) {
                        MultiAnswerCorrect::where('exam_id', $id)->where('question_id', $request->question_number)->where('answer',$i)->first()->delete();
                    }

                    if (isset($item['check'])) {
                        if ($item['set'] == 0 && $item['check'] == 'on') {
                            $answerCorrect = new MultiAnswerCorrect();
                            $answerCorrect->answer = $i;
                            $answerCorrect->exam_id = $id;
                            $answerCorrect->question_id = $request->question_number;
                            $answerCorrect->save();
                        }
                    }
                }
        }
        if ($request->answers != null) {
            foreach ($request->answers as $i => $answer) {
                $change = Answer::where('question_id', $request->question_id)->where('answer_id', $i)->first();
                $change->answer = $answer['answer'];
                $change->save();
            }
        }
    //     switch (Auth::user()->role)
    //     {
    //         case 1:
    //             return redirect('admin/exam/edit/'.$id);
    //                 break;
    //         case 2:
    //             return redirect('editor/exam/edit/'.$id);
    //                 break;
    //     }
    }
    /**
     * @Route("/api/exam/question/destroy/{id}", name="apiExamQuestionDestroy", methods="GET")
     */   
    public function destroy(Requests $request, $id)
    {
        $question = $doctrine->getRepository(Exam::class)->findOneBy(['id'=>$id])->getQuestions();
        print_r($question);
    }

    private function authenticateAdmin(){
        $roles = $this->getUser()->getRoles();
        if(!in_array('ROLE_ADMIN',$roles)){
            return new Responce("Brak roli Admina",403);
        }
    }
}