@extends('layouts.app_header')

@section('title', 'management')

@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-body">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-question-tab" data-toggle="tab" href="#nav-question" role="tab" aria-controls="nav-question" aria-selected="true">Question</a>
                <a class="nav-link" id="nav-gift-tab" data-toggle="tab" href="#nav-gift" role="tab" aria-controls="nav-gift" aria-selected="false">Gift</a>
                <a class="nav-link" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="false">User</a>
            </div>
            </nav>
                <div class="tab-content" id="nav-tabContent">

                <!-- 行クリック参考：http://kachibito.net/snippets/table-tr-link-clickable -->

                <!-- QUESTIONS -->
                <div class="tab-pane fade show active" id="nav-question" role="tabpanel" aria-labelledby="nav-question-tab">
                    <h1 style="margin:30px 0;">Question List</h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $questionsData as $question )
                            <tr>
                                <th scope="row">{{ $question->id }}</th>
                                <td><a href="{{ route('admin.question_details', $question->id) }}">{{ $question->text }}</a></td>
                                <td>Answer</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- GIFTS -->
                <div class="tab-pane fade" id="nav-gift" role="tabpanel" aria-labelledby="nav-gift-tab">
                <h1 style="margin:30px 0;">Gift List</h1>
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $giftsData as $gift )
                            <tr>
                                <th scope="row">{{ $gift->image_path }}</th>
                                <td>{{ $gift->name }}</td>
                                <td>quantity</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- USERS -->
                <div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                <h1 style="margin:30px 0;">User List</h1>
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $usersData as $user )
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->point }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
    </div>
</div>
@endsection
