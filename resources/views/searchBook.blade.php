@extends('layouts.base')
@section('content')
<div class="container">
    @if($publications == null)
    <h3>No Records</h3>
    @else
    <h3>Publication Details</h3>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th data-field="title">Title</th>
                        <th data-field="author">Author</th>
                        <th data-field="publisher">Publisher</th>
                        <th data-field="availablity">Availablity for Issue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publications as $publication)
                        <tr>
                            <td>{{ $publication->title }}</td>
                            <td>{{ $publication->author }}</td>
                            <td>{{ $publication->publisher }}</td>
                            <td>{{ $status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@stop
