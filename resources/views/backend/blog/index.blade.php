@extends('layouts.backend')

@section('title', 'MyBlog | Blog Index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Display all blog posts</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Sr. #</td>
                                        <td width="">Title</td>
                                        <td width="120">Author</td>
                                        <td width="150">Category</td>
                                        <td width="150">Date</td>
                                        <td width="80">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>

                                @php
                                    $counter = 1;
                                @endphp
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author->name}}</td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>
                                            <abbr title="{{ $post->dateFormatted(true) }}">{{ $post->dateFormatted() }}</abbr>
                                            {!! $post->publicationLabel() !!}
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="" class="btn btn-xs btn-danger">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                {{ $posts->render() }}
                            </div>
                            <div class="pull-right">

                                @php
                                    $postCount = $posts->count();
                                @endphp
                                <small>{{ $postCount }} {{ Str::plural('item', $postCount) }}</small>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- ./row -->
        </section>
    </div>
@endsection
