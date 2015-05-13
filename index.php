<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BetaSerie - Mon NAS</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- source : http://stackoverflow.com/questions/10758897/parsing-json-array-with-php-foreach -->
  </head>
  
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span class="light">BetaSerie</span>- Mon NAS</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="page-scroll" href="#member-info">Membre</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Intro Header -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>Explication de ce site</p>
      </div>
    </div>

    <!-- members-info Section -->
    <div id="member-info" class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h3 class="text-center"> MEMBERS-INFO.json </h3>
                <?php

                    // Si les données json sont dans un fichier distant:
                    $json_source = file_get_contents('members-info.json');

                    // Décode le JSON
                    $json_data = json_decode($json_source);

                    //print_r($json_source);
                    //var_dump($json_source);

                    // Affiche la valeur des attributs du JSON
                    
                ?>

                    <div class="progress progress-striped active">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>

                    <h4><? echo 'Information Utilisateur :'.'</br>'.'</br>'; ?></h4>
                    
                    <div class="panel panel-success">
                        <!-- - LOGIN USER - ID USER -->
                         <div class="panel-heading">
                            <h4 class="panel-title"><? echo $json_data->member->login.' - '.$json_data->member->id; ?></h5>
                        </div>
                    
                        <!-- Temps passé/restant devant la TV -->
                        <div class="panel-body">
                            <h5><? echo '  Time On TV:   '; ?></h4>
                            <p><? echo $json_data->member->stats->time_on_tv.'</br>'; ?></p>
                            <h5><? echo '  Time To TV:   '; ?></h4>
                            <p><? echo $json_data->member->stats->time_to_spend.'</br>'; ?></p>
                        </div>
                    </div>

                <!-- Serie -->

                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>    

                <h4><? echo 'Series :'.'</br>'.'</br>'; ?></h4>

                <?

                    foreach($json_data->member->shows as $shows) {
    
                        if ($shows->user->archived != 'true') {
                ?>
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <!-- - TITRE SERIE - -->
                                <h5 class="list-group-item-heading"><? echo $shows->title.'</br>'; ?></h5>
                            
                                <!-- - ID SERIE - -->
                                <p class="list-group-item-text"><? echo '('.$shows->id; ?>
                            
                                <!-- - ID SERIE - -->
                                <? echo ' - '.$shows->thetvdb_id; ?>
                            
                                <!-- - ID SERIE - -->
                                <? echo ' - '.$shows->imdb_id.')'.'</br>'; ?></p>

                                <!-- - Dernier episode - -->
                                <p class="list-group-item-text"><? echo ' Dernier ep vu: '.$shows->user->last.'</br>'; ?></p>
                            
                                <!-- - LIEN SERIE - -->
                                <p class="list-group-item-text"><? echo $shows->resource_url.'</br>'; ?></p>
                            </a>
                        </div>
                            
                <? 
                        }
                    }

                ?>

                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>

                    <h4><? echo 'Series Archivés'.'</br>'; ?></h4>

                <?
                    foreach($json_data->member->shows as $shows2) {

                        if ($shows->user->archived == 'true') {
                ?>
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <!-- - TITRE SERIE - -->
                                    <h5><? echo $shows2->title.'</br>'; ?></h5>
                            
                                    <!-- - ID SERIE - -->
                                    <p class="list-group-item-text"><? echo '('.$shows2->id; ?>
                            
                                    <!-- - ID SERIE - -->
                                    <? echo ' - '.$shows2->thetvdb_id; ?>
                            
                                    <!-- - ID SERIE - -->
                                    <? echo ' - '.$shows2->imdb_id.')'.'</br>'; ?></p>

                                    <!-- - Dernier episode - -->
                                    <p class="list-group-item-text"><? echo ' Dernier ep vu: '.$shows2->user->last.'</br>'; ?></p>
                            
                                    <!-- - LIEN SERIE - -->
                                    <p class="list-group-item-text"><? echo $shows2->resource_url.'</br>'; ?></p>
                                </a>
                            </div>
                            
                <?          
                        }
                    }

                ?>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>