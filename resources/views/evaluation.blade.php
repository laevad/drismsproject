@extends('layouts.header') 
@section('content')      
    @include("layouts/includes/sidebar")     
    <style>

      html, body {
      min-height: 100%;
      }
      body, div, form, input, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      font-weight: 400;
      }
      h4 {
      margin-bottom: 0;
      }
      hr {
      margin: 20px 0;
      }
      span.required {
      color: red;
      }
      .main-block {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 3px;
      }
      form {
      width: 100%;
      padding: 20px;
      box-shadow: 0 2px 5px #ccc; 
      background: #fff;
      }
      th, td {
      width: 12%;
      text-align: center;
      vertical-align: unset;
      line-height: 18px;
      font-weight: 400;
      word-break: break-all;
      }
      .first-col {
      width: 38%;
      text-align: left;
      }
      textarea:hover {
      border: 1px solid #095484;
      outline: none;
      }
      .comments-block, .radio-block {
      margin: 30px 0;
      }
      .comments, question, .answer, .question-answer, table {
      width: 100%;
      }
      .comments {
      margin: 0;
      }
      small {
      display: block;
      line-height: 18px;
      opacity: 0.5;
      }
      textarea {
      width: calc(100% - 6px);
      }
      .question-answer >div {
      display: inline-block;
      margin-left: 30px;
      }
      .btn-block {
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #095484;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #0666a3;
      }
      @media (min-width: 568px) {
      .comments-block, .radio-block {
      display: flex;
      justify-content: space-between;
      }
      .comments  {
      width: 30%;
      }
      .answer {
      width: 70%;
      }
      .question, .question-answer {
      width: 50%;
      }
      th, td {
      word-break: keep-all;
      }
      } 

</style>

<!-- main content -->
<div class="main-content"> 
    <div class="main-block">
      <form action="{{ route('instructor.evaluation.store')}}" method="post">
        @csrf 

        <input type="hidden" name="instructor_id" value="{{$instructor_id}}"/>
        <input type="hidden" name="classes_id" value="{{$classes_id}}"/>
        <input type="hidden" name="classes" value="{{$classes}}"/>

         

        <h1>Driving Instructor Evaluation Form</h1>
        <p>DriSMS's Driving Instructor Evaluation form</p>
        <h3>Rate this course using the following scale:</h3>
        <p>5 - Outstanding ||   The Performance almost always exceeds the job requirements. </p>
        <p>4 - Very Satisfactory || The performance meets and often exceeds the job requirements</p>
        <p>3 - Satisfactory || The performance meets job requirements</p>
        <p>2 - Fair || The performance needs some development to meet job requirements</p>
        <p>1 - Poor || The faculty fails to meet job requirements</p>
        
        
        
        <hr>
        <div>
          <h4>Knowledge of Matter<span class="required">*</span></h4>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>Outstanding</th>
              <th>Very Satisfactory</th>
              <th>Satisfactory</th>
              <th>Fair</th>
              <th>Poor</th>
            </tr>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span> Demonstrates sensitivity to students' ability and absorb content information</td>
              <td><input type="radio" value="5" name="demonstrates_sensivity_to_students" required /></td>
              <td><input type="radio" value="4" name="demonstrates_sensivity_to_students" required/></td>
              <td><input type="radio" value="3" name="demonstrates_sensivity_to_students" required/></td>
              <td><input type="radio" value="2" name="demonstrates_sensivity_to_students" required/></td>
              <td><input type="radio" value="1" name="demonstrates_sensivity_to_students" required/></td>
            </tr>
          </table>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span>Keeps accurate records of students' performance and prompt submission of same</td>
              <td><input type="radio" value="5" name="keeps_accurate_records_of_students" required/></td>
              <td><input type="radio" value="4" name="keeps_accurate_records_of_students" required/></td>
              <td><input type="radio" value="3" name="keeps_accurate_records_of_students" required/></td>
              <td><input type="radio" value="2" name="keeps_accurate_records_of_students" required/></td>
              <td><input type="radio" value="1" name="keeps_accurate_records_of_students" required/></td>
            </tr>
          </table>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span>Demonstrates mastery of the subject matter.</td>
              <td><input type="radio" value="5" name="demonstrates_mastery_subject_matter" required/></td>
              <td><input type="radio" value="4" name="demonstrates_mastery_subject_matter" required/></td>
              <td><input type="radio" value="3" name="demonstrates_mastery_subject_matter" required/></td>
              <td><input type="radio" value="2" name="demonstrates_mastery_subject_matter" required/></td>
              <td><input type="radio" value="1" name="demonstrates_mastery_subject_matter" required/></td>
            </tr>
          </table>
        </div>
        <div>
          <h4>Instructor Evaluation</h4>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span>Creates teaching strategies that allow students to practice using concepts they need to understand (interactive discussion).</td>
              <td><input type="radio" value="5" name="creates_teaching_strategies" /></td>
              <td><input type="radio" value="4" name="creates_teaching_strategies" /></td>
              <td><input type="radio" value="3" name="creates_teaching_strategies" /></td>
              <td><input type="radio" value="2" name="creates_teaching_strategies" /></td>
              <td><input type="radio" value="1" name="creates_teaching_strategies" /></td>
            </tr>
          </table>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span>Enhances student self-esteem and/or gives due recognition to students' performance/potentials.</td>
              <td><input type="radio" value="5" name="enhances_student_self_esteem" /></td>
              <td><input type="radio" value="4" name="enhances_student_self_esteem" /></td>
              <td><input type="radio" value="3" name="enhances_student_self_esteem" /></td>
              <td><input type="radio" value="2" name="enhances_student_self_esteem" /></td>
              <td><input type="radio" value="1" name="enhances_student_self_esteem" /></td>
            </tr>
          </table>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span>Encourage students to learn beyond what is required and help/guide the students how to apply the concepts.</td>
              <td><input type="radio" value="5" name="encourage_students" /></td>
              <td><input type="radio" value="4" name="encourage_students" /></td>
              <td><input type="radio" value="3" name="encourage_students" /></td>
              <td><input type="radio" value="2" name="encourage_students" /></td>
              <td><input type="radio" value="1" name="encourage_students" /></td>
            </tr>
          </table>
          <table>
            <tr>
              <th class="first-col"></th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>1</th>
            </tr>
            <tr>
              <td class="first-col"><span class="required">*</span>Designs and implements learning conditions and experience that promotes healthy exchange and/or confrontations.</td>
              <td><input type="radio" value="5" name="designs_and_implements_learning_conditions" /></td>
              <td><input type="radio" value="4" name="designs_and_implements_learning_conditions" /></td>
              <td><input type="radio" value="3" name="designs_and_implements_learning_conditions" /></td>
              <td><input type="radio" value="2" name="designs_and_implements_learning_conditions" /></td>
              <td><input type="radio" value="1" name="designs_and_implements_learning_conditions" /></td>
            </tr>
          </table>
        </div>
        <div class="comments-block">
          <h4 class="comments"><span class="required">*</span>Comments<small>Please let us know what could be done to improve this course</small></h4>
          <div class="answer">
            <textarea rows="5" name="comments"></textarea>
          </div>
        </div>
        <div class="radio-block">
          <p class="question">May We Use Your Quotes / Comments?</p>
          <div class="question-answer">
            <div>
              <input type="radio" value="none" id="radioYes" name="allow_comment_use" />
              <label for="radioYes" class="radio">Yes</label>
            </div>
            <div>
              <input type="radio" value="none" id="radioNo" name="allow_comment_use" />
              <label for="radioNo" class="radio">No</label>
            </div>
          </div>
        </div>
        <div class="btn-block">
          <input type="submit" class="btn btn-primary" value="Submit"> 
        </div>
      </form>
    </div>
</div>
@include('../layouts/includes/footer')   
@endsection