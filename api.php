<?php
require_once('config.php');
//artistes

function get_list_artists($pdo)//lister les artistes
{
<<<<<<< HEAD
	$sql = "SELECT * FROM albums"; $exe = $pdo->query($sql);
	$Liste_albums = array();
	while($result = $exe->fetch(PDO::FETCH_OBJ))
		{
			array_push($Liste_albums, array("ID" => $result->id, "artist_id" => $result->artist_id, "name" => $result->name, "description" => $result->description, "cover" => $result->cover, "cover_small" => $result->cover_small, "release_date" => $result->release_date, "popularity" => $result->popularity));
		}
		return $Liste_albums;
=======
$sql = "SELECT name FROM artists"; $exe = $pdo->query($sql);
$Liste_artists = array();
while($result = $exe->fetch(PDO::FETCH_OBJ))
{
array_push($Liste_artists, array("ID" => $result->id, "name" => $result->name, "description" => $result->description, "bio" => $result->bio, "photo" => $result->photo));
}
return $Liste_artist;
>>>>>>> 087e66d2fcb419eb979949f482906aecfbaf4f45
}

function get_artists_by_id($id, $pdo)//Voir le detail d'un artist
{
<<<<<<< HEAD
	$sql = "SELECT * FROM artists"; $exe = $pdo->query($sql);
	$Liste_artists = array();
	while($result = $exe->fetch(PDO::FETCH_OBJ))
		{
			array_push($Liste_artists, array("ID" => $result->id, "name" => $result->name, "description" => $result->description, "bio" => $result->bio, "photo" => $result->photo));
		}
		return $Liste_artist;
}

		function get_list_genres($pdo)
		{
			$sql = "SELECT * FROM genres"; $exe = $pdo->query($sql);
			$Liste_genres = array();
			while($result = $exe->fetch(PDO::FETCH_OBJ))
				{
					array_push($Liste_genres, array("ID" => $result->id, "name" => $result->name));
				}
				return $Liste_genres;
			}

			function get_list_genres_albums($pdo)
			{
				$sql = "SELECT * FROM genres_albums"; $exe = $pdo->query($sql);
				$Liste_genres_albums = array();
				while($result = $exe->fetch(PDO::FETCH_OBJ))
					{
						array_push($Liste_genres_albums, array("genre_id" => $result->genre_id, "album_id" => $result->album_id));
					}
					return $Liste_genres_albums;
				}

				function get_list_tracks($pdo)
				{
					$sql = "SELECT * FROM tracks"; $exe = $pdo->query($sql);
					$Liste_tracks = array();
					while($result = $exe->fetch(PDO::FETCH_OBJ))
						{
							array_push($Liste_tracks, array("ID" => $result->id, "album_id" => $result->album_id, "name" => $result->name, "track_no" => $result->track_no, "duration" => $result->duration, "mp3" => $result->mp3));
						}
						return $Liste_tracks;
					}

					function get_albums_by_id($id, $pdo)
					{
						$sql = "SELECT * FROM albums WHERE ID = '$id'";
						$exe = $pdo->query($sql);
						while($result = $exe->fetch(PDO::FETCH_OBJ))
							{
								$Detail_albums = array("artist_id" => $result->artist_id, "name" => $result->name, "description" => $result->description, "cover" => $result->cover, "cover_small" => $result->cover_small, "release_date" => $result->release_date, "popularity" => $result->popularity, "Albums" => $result->Albums);
							}
							return $Detail_albums;
						}
=======
$sql = "SELECT * FROM artists WHERE ID = '$id'";
$exe = $pdo->query($sql);
while($result = $exe->fetch(PDO::FETCH_OBJ))
{
$Detail_artists = array("artist_id" => $result->artist_id, "name" => $result->name, "description" => $result->description, "cover" => $result->cover, "cover_small" => $result->cover_small, "release_date" => $result->release_date, "popularity" => $result->popularity, "Albums" => $result->Albums);
}
return $Detail_artists;
}

//albums

function get_list_albums($pdo)//lister les albums
{
$sql = "SELECT name FROM albums"; $exe = $pdo->query($sql);
$Liste_albums = array();
while($result = $exe->fetch(PDO::FETCH_OBJ))
{
array_push($Liste_albums, array("ID" => $result->id, "artist_id" => $result->artist_id, "name" => $result->name, "description" => $result->description, "cover" => $result->cover, "cover_small" => $result->cover_small, "release_date" => $result->release_date, "popularity" => $result->popularity));
}
return $Liste_albums;
}

function get_albums_by_id($id, $pdo)//Voir les details d'un album + nom de l'artiste
{
$sql = "SELECT *, artists.name FROM albums JOIN artists ON artists.id=albums.artist_id WHERE albums.ID = '$id'";
$exe = $pdo->query($sql);
while($result = $exe->fetch(PDO::FETCH_OBJ))
{
$Detail_albums = array("artist_id" => $result->artist_id, "name" => $result->name, "description" => $result->description, "cover" => $result->cover, "cover_small" => $result->cover_small, "release_date" => $result->release_date, "popularity" => $result->popularity, "Albums" => $result->Albums);
}
return $Detail_albums;
}

//tracks

function get_tracks_by_id($id, $pdo)//Voir le detail d'un track
{
$sql = "SELECT * FROM tracks WHERE ID = '$id'";
$exe = $pdo->query($sql);
while($result = $exe->fetch(PDO::FETCH_OBJ))
{
$Detail_tracks = array("album_id" => $result->album_id, "name" => $result->name, "track_no" => $result->track_no, "duration" => $result->duration, "mp3" => $result->mp3);
}
return $Detail_tracks;
}

//genres

function get_list_genres($pdo)//lister les genres
{
$sql = "SELECT * FROM genres"; $exe = $pdo->query($sql);
$Liste_genres = array();
while($result = $exe->fetch(PDO::FETCH_OBJ))
{
array_push($Liste_genres, array("ID" => $result->id, "name" => $result->name));
}
return $Liste_genres;
}
>>>>>>> 087e66d2fcb419eb979949f482906aecfbaf4f45


$possible_url = array("get_list_albums", "get_albums", "get_list_artists", "get_list_genres", "get_list_genres_albums", "get_list_tracks", "get_albums_by_id"); //je définis les URLs valables

$value = "Une erreur est survenue"; //je mets le message d'erreur par défaut dans une variable

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url)) { //si l'URL est OK

switch ($_GET["action"]) {

case "get_list_albums": $value = get_list_albums($pdo); break; //Je récupère la liste des articles
case "get_list_artists": $value = get_list_albums($pdo); break;
case "get_list_genres": $value = get_list_albums($pdo); break;
case "get_list_tracks": $value = get_list_albums($pdo); break;
case "get_albums_by_id": if (isset($_GET["id"])) $value = get_albums_by_id($_GET["id"], $pdo); //si l'ID est spécifié alors je renvoie l'article en question
else $value = "Argument manquant"; break; } //si l'ID n'est pas valable je change mon message d'erreur

}

exit(json_encode($value));

?>
