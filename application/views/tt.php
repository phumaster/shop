<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>get link</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('css/sb-admin.css'); ?>" rel="stylesheet">

        <!-- Morris Charts CSS -->

        <!-- Custom Fonts -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery -->
        <style>img {width: 80px;transition: all 300ms ease;}</style>

        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <script type="text/javascript">
            $(function () {
                var img = $('img');
                $('img.inlineimg').remove();
                $('a').remove();
                img.hover(function(){
                    $(this).css({
                        'width':'350px',
                        'transform':'scale(1.3)'
                    });
                }, function(){
                    $(this).css({
                        'width':'80px',
                        'transform':'scale(1)'
                    });
                });
            });
        </script>
        

    </head>