@extends('app')

@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Help
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-question-circle"></i> Help
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <h2>Supported Tools</h2>
            <p>
                Lorem ipsum dolor sit amet ...
            <ul>
                <li>Recon-ng (<a href="https://bitbucket.org/LaNMaSteR53/recon-ng">https://bitbucket.org/LaNMaSteR53/recon-ng</a>)</li>
                <li>Cree.py (<a href="http://www.geocreepy.com">http://www.geocreepy.com</a>)</li>
                <li>Maltego (<a href="https://www.paterva.com/web6/products/maltego.php">https://www.paterva.com/web6/products/maltego.php</a>)</li>
            </ul>
            </p>
            <h2>How can I use the tools?</h2>
            <p>
                Lorem ipsum dolor sit amet ...
            <ul>
                <li>Foo</li>
                <li>Bar</li>
                <li>Lorem</li>
            </ul>
            </p>
            <h2>Foobar</h2>
            <p>Lorem ipsum dolor sit amet ...</p>
        </div>
    </div>
    <!-- /.row -->
@stop