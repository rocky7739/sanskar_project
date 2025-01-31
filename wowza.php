<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://player.wowza.com/player/latest/wowzaplayer.min.js"></script>
</head>
<body>
	<div id="playerElement" style="width:50%; height:100px; padding:0 0 56.25% 0"></div>
</body>
<script type="text/javascript">
WowzaPlayer.create('playerElement',
    {
    "license":"PLAY1-8kabY-RjrFN-RUnzD-JKP8Z-QzuBj",
    "title":"",
    "description":"",
    //"sourceURL":"http%3A%2F%2F13.127.166.4%3A1935%2Flive%2FmyStream%2Fplaylist.m3u8",
"sourceURL":"http://ec2-13-127-166-4.ap-south-1.compute.amazonaws.com:1935/aws/_definst_/mp4:amazons3/bhaktiappproduction/videos/2793508videoplayback.mp4/playlist.m3u8",
    "autoPlay":false,
    "volume":"75",
    "mute":false,
    "loop":false,
    "audioOnly":false,
    "uiShowQuickRewind":true,
    "uiQuickRewindSeconds":"30"
    }
);
</script>
</html>

