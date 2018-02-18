<?php
require_once('config.php');
//artistes

function get_list_artists($pdo)//lister les artistes et leurs infos C
{
  $sql = "SELECT artists.*, albums.name as 'Album' FROM artists JOIN albums ON artists.id=albums.artist_id GROUP BY artists.name"; $exe = $pdo->query($sql);
  $Liste_artists = array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Liste_artists, array("ID" => $result->id, "name" => $result->name, "description" => $result->description, "bio" => $result->bio, "photo" => $result->photo));
  }
  return $Liste_artists;
}

function get_artists_by_id($name, $pdo)//Voir le detail d'un artist+nom de leur album+genre de l'album C
{
  $sql = "SELECT artists.*,  albums.name as 'Album' FROM artists JOIN albums ON artists.id=albums.artist_id WHERE artists.name LIKE '%$name%' GROUP BY artists.name
  ";

  $exe = $pdo->query($sql);
  $Detail_artists=array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Detail_artists, array("artist_id" => $result->id, "name"=>$result->name, "description" => $result->description, "bio" => $result->bio, "photo" => $result->photo, "album" => $result->Album));
  }
  return $Detail_artists;
}

//albums

function get_list_albums($pdo)//lister les albums C
{
  $sql = "SELECT albums.name AS 'album', artists.name AS 'artist', genres.name AS 'genre', COUNT(tracks.id) as 'Nbtracks'
  FROM albums JOIN artists ON albums.artist_id=artists.id JOIN genres_albums ON genres_albums.album_id=albums.id
  JOIN genres ON genres.id=genres_albums.genre_id JOIN tracks ON tracks.album_id=albums.id GROUP BY albums.id ORDER BY albums.name"; $exe = $pdo->query($sql);
  $Liste_albums = array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Liste_albums, array("album" => $result->album, "artist" => $result->artist, "genre" => $result->genre, "Nombre de track" => $result->Nbtracks));
  }
  return $Liste_albums;
}

function get_albums_by_artist($name, $pdo)
{
  $sql="SELECT albums.name FROM albums JOIN artists ON albums.artist_id=artists.id WHERE artists.name LIKE '%Adam Fielding%' ORDER BY albums.name";
  $exe = $pdo->query($sql);
  $albums=array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($albums, array("album" => $result->name));
  }
  return $albums;
}

function get_albums_by_id($name, $pdo)//Voir les details d'un album + nom de l'artiste C
{
  $sql = "SELECT albums.name AS 'album', artists.name AS 'artist', genres.name AS 'genre', COUNT(tracks.id) as 'Nbtracks' FROM albums
  JOIN artists ON albums.artist_id=artists.id JOIN genres_albums ON genres_albums.album_id=albums.id JOIN genres ON genres.id=genres_albums.genre_id
  JOIN tracks ON tracks.album_id=albums.id WHERE albums.name LIKE '%$name%' ";
  $exe = $pdo->query($sql);
  $Detail_albums=array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Detail_albums, array("album" => $result->album, "artist" => $result->artist, "genre" => $result->genre, "Nbtracks" => $result->Nbtracks));
  }
  return $Detail_albums;
}

//tracks
function get_tracks_by_album($name, $pdo)//Voir le detail d'un track C
{
  $sql = "SELECT tracks.*, SEC_TO_TIME(duration) AS 'duration', artists.name AS 'artist', albums.name AS 'album', genres.name AS 'genre' FROM tracks
  JOIN albums ON tracks.album_id = albums.id
  JOIN artists ON albums.artist_id=artists.id
  JOIN genres_albums ON genres_albums.album_id=tracks.album_id
  JOIN genres ON genres.id=genres_albums.genre_id WHERE albums.name LIKE '%$name%' GROUP BY tracks.name ORDER BY track_no";
  $exe = $pdo->query($sql);
  $Detail_tracks=array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Detail_tracks, array("album_id" => $result->album_id, "name" => $result->name, "track_no" => $result->track_no, "duration" => $result->duration, "mp3" => $result->mp3, "artist" => $result->artist, "album" => $result->album, "genre" => $result->genre));
  }
  return $Detail_tracks;
}
function get_tracks_by_id($name, $pdo)//Voir le detail d'un track C
{
  $sql = "SELECT tracks.*, artists.name AS 'artist', albums.name AS 'album', genres.name AS 'genre' FROM tracks
  JOIN albums ON tracks.album_id = albums.id
  JOIN artists ON albums.artist_id=artists.id
  JOIN genres_albums ON genres_albums.album_id=tracks.album_id
  JOIN genres ON genres.id=genres_albums.genre_id
  WHERE tracks.name LIKE '%$name%'";
  $exe = $pdo->query($sql);
  $Detail_tracks=array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Detail_tracks, array("album_id" => $result->album_id, "name" => $result->name, "track_no" => $result->track_no, "duration" => $result->duration, "mp3" => $result->mp3, "arist" => $result->artist, "album" => $result->album, "genre" => $result->genre));
  }
  return $Detail_tracks;
}

//genres

function get_list_genres($pdo)//lister les genres
{
  $sql = "SELECT albums.*, genres.name AS 'Genre' FROM albums JOIN genres_albums ON albums.id = genres_albums.album_id JOIN genres ON genres_albums.genre_id = genres.id JOIN artists ON albums.artist_id = artists.id"; $exe = $pdo->query($sql);
  $Liste_genres = array();
  while($result = $exe->fetch(PDO::FETCH_OBJ))
  {
    array_push($Liste_genres, array("ID" => $result->id, "name" => $result->name));
  }
  return $Liste_genres;
}

// Voir le détail d’un genre et les id des albums le possédant
function get_genre_album($name, $pdo) // récupère tous les albums du même genre
{
  $sql = "SELECT albums.*, genres.name AS 'Genre', artists.name AS 'Artiste' FROM albums JOIN genres_albums ON albums.id = genres_albums.album_id JOIN genres ON genres_albums.genre_id = genres.id
  JOIN artists ON albums.artist_id = artists.id WHERE genres.name LIKE '%$name%'";
  $exe = $pdo->query($sql);
  $Genre_album = array();

  while($result = $exe->fetch(PDO::FETCH_OBJ)) {
    array_push($Genre_album, array("id" => $result->id, "artistId" => $result->artist_id, "Name" => $result->name,
    "Description" => $result->description, "Cover" => $result->cover, "CoverSmall" => $result->cover_small,
    "ReleaseDate" => $result->release_date, "Popularity" => $result->popularity, "Genre" => $result->Genre, "Artiste" => $result->Artiste));
  }
  return $Genre_album;
}


$possible_url = array("get_list_artists","get_albums_by_artist", "get_tracks_by_album", "get_artists_by_id", "get_list_albums", "get_albums_by_id", "get_tracks_by_id", "get_list_genres", "get_genre_album"); //je définis les URLs valables

$value = "Une erreur est survenue"; //je mets le message d'erreur par défaut dans une variable

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url)) { //si l'URL est OK

  switch ($_GET["action"])
  {
    case "get_list_artists": $value = get_list_artists($pdo); break;
    case "get_list_albums": $value = get_list_albums($pdo); break; //Je récupère la liste des articles
    case "get_list_genres": $value = get_list_genres($pdo); break;
    case "get_albums_by_id":if (isset($_GET["name"]))$value = get_albums_by_id($_GET["name"], $pdo);
    else $value = "Argument manquant"; break;
    case "get_artists_by_id":if (isset($_GET["name"]))$value = get_artists_by_id($_GET["name"], $pdo);
    else $value = "Argument manquant";break;
    case "get_tracks_by_id":if (isset($_GET["name"]))$value = get_tracks_by_id($_GET["name"], $pdo);
    else $value = "Argument manquant"; break;
    case "get_genre_album":if (isset($_GET["name"]))$value = get_genre_album($_GET["name"], $pdo); //si l'ID est spécifié alors je renvoie l'article en question
    else $value = "Argument manquant";break;
    case "get_tracks_by_album":if (isset($_GET["name"]))$value = get_tracks_by_album($_GET["name"], $pdo); //si l'ID est spécifié alors je renvoie l'article en question
    else $value = "Argument manquant";break;
    case "get_albums_by_artist":if (isset($_GET["name"]))$value = get_albums_by_artist($_GET["name"], $pdo); //si l'ID est spécifié alors je renvoie l'article en question
    else $value = "Argument manquant";break;
  } //si l'ID n'est pas valable je change mon message d'erreur

}


exit(json_encode($value));

?>
