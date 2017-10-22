<?php
error_reporting(0);
ini_set('display_errors', 0);
function yt_recent($ch_id)
{
    $api_key = '';
    $data = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$ch_id."&maxResults=1&order=date&type=video&key=".$api_key.""), true);
    $videoid = $data['items'][0]['id']['videoId'];//returns video id
    $data1 = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" . $videoid . "&key=".$api_key.""), true);
    $data2 = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" . $videoid . "&key=".$api_key.""), true);
    if (is_null($data1['items'][0]['snippet']['thumbnails']['maxres']['url'])){$thumbnail_mr = NULL;}else{$thumbnail_mr = $data1['items'][0]['snippet']['thumbnails']['maxres']['url'];};//returns thumbnail max res
    if (is_null($data1['items'][0]['snippet']['thumbnails']['standard']['url'])){$thumbnail = NULL;}else{$thumbnail = $data1['items'][0]['snippet']['thumbnails']['standard']['url'];};//returns thumbnail standard
    $videotitle = $data1['items'][0]['snippet']['title'];//returns title
    $channel = $data1['items'][0]['snippet']['channelTitle'];//returns channel name
    $views = $data2['items'][0]['statistics']['viewCount'];//returns video views
    $likecount = $data2['items'][0]['statistics']['likeCount'];//returns video likes
    $dislikecount = $data2['items'][0]['statistics']['dislikeCount'];//returns video dislikes
    $comments = $data2['items'][0]['statistics']['commentCount'];//returns video comment amount
    $tag = $data1['items'][0]['snippet']['tags'][0];//returns tag 1
    $tag1 = $data1['items'][0]['snippet']['tags'][1];//returns tag 2
    $tag2 = $data1['items'][0]['snippet']['tags'][2];//returns tag 3
    $tag3 = $data1['items'][0]['snippet']['tags'][3];//returns tag 4
    $tag4 = $data1['items'][0]['snippet']['tags'][4];//returns tag 5
    $videolink = "https://www.youtube.com/watch?v=".$videoid."";//video link
    $videolinkembed = "https://www.youtube.com/embed/".$videoid."";//video link for iframe
    return array(
        'channelId' => $ch_id,
        'channel' => $channel,
        'videoId' => $videoid,
        'thumbnail' => $thumbnail,
        'thumbnail_mr' => $thumbnail_mr,
        'title' => $videotitle,
        'views' => $views,
        'likes' => $likecount,
        'dislikes' => $dislikecount,
        'comments' => $comments,
        'videoLink' => $videolink,
        'videoLinkEmbed' => $videolinkembed,
        'tag' => $tag,
        'tag1' => $tag1,
        'tag2' => $tag2,
        'tag3' => $tag3,
        'tag4' => $tag4
    );
}
function yt_details($ch_id){
    $api_key = '';
    $data = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=snippet&forUsername=".$ch_id."&key=".$api_key.""), true);
    $data1 = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=".$ch_id."&key=".$api_key.""), true);
    $data2 = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&forUsername=".$ch_id."&key=".$api_key.""), true);
    $channel = $data['items'][0]['snippet']['title'];//returns channel name
    $channel_id = $data['items'][0]['id'];//returns channel id
    if (is_null($data['items'][0]['snippet']['customUrl'])){$url = NULL;}else{$url = $data['items'][0]['snippet']['customUrl'];};//returns channel custom url
    if (is_null($data2['items'][0]['brandingSettings']['channel']['keywords'])){$keywords = NULL;}else{$keywords = $data2['items'][0]['brandingSettings']['channel']['keywords'];};//returns keywords
    if (is_null($data2['items'][0]['brandingSettings']['image']['bannerImageUrl'])){$banner = NULL;}else{$banner = $data2['items'][0]['brandingSettings']['image']['bannerImageUrl'];};//returns banner
    if (is_null($data2['items'][0]['brandingSettings']['image']['bannerTvMediumImageUrl'])){$banner2 = NULL;}else{$banner2 = $data2['items'][0]['brandingSettings']['image']['bannerTvMediumImageUrl'];};//returns bannerTvMediumImageUrl
    if (is_null($data2['items'][0]['brandingSettings']['image']['bannerTvHighImageUrl'])){$banner3 = NULL;}else{$banner3 = $data2['items'][0]['brandingSettings']['image']['bannerTvHighImageUrl'];};//returns bannerTvMediumImageUrl
    $description = $data['items'][0]['snippet']['description'];//returns channel description
    $start_date = $data['items'][0]['snippet']['publishedAt'];//returns channel created date
    $avatar = $data['items'][0]['snippet']['thumbnails']['high']['url'];//returns channel avatar
    $subs = $data1['items'][0]['statistics']['subscriberCount'];//returns subs
    $views = $data1['items'][0]['statistics']['viewCount'];//returns views
    $videos = $data1['items'][0]['statistics']['videoCount'];//returns video count
    $comments = $data1['items'][0]['statistics']['commentCount'];//returns comments count
    $start_date_formatted = date("F j, Y", strtotime($start_date));
    return array(
        'channelId' => $channel_id,
        'channel' => $channel,
        'url' => $url,
        'keywords' => $keywords,
        'description' => $description,
        'startDate' => $start_date,
        'startDateFormatted' => $start_date_formatted,
        'avatar' => $avatar,
        'subs' => $subs,
        'views' => $views,
        'comments' => $comments,
        'videos' => $videos,
        'banner' => $banner,
        'bannerMed' => $banner2,
        'bannerLarge' => $banner3
    );
}
?>
