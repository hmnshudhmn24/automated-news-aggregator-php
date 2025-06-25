<?php

function fetchNews($topic) {
    $apiKey = 'YOUR_NEWSAPI_KEY';
    $url = "https://newsapi.org/v2/everything?q=" . urlencode($topic) . "&sortBy=publishedAt&apiKey=$apiKey";

    $response = file_get_contents($url);
    return json_decode($response, true);
}

function summarizeText($text) {
    $apiKey = 'YOUR_OPENAI_API_KEY';
    $data = [
        "model" => "gpt-3.5-turbo",
        "messages" => [["role" => "user", "content" => "Summarize this in 2 lines: $text"]],
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey",
            'content' => json_encode($data)
        ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents('https://api.openai.com/v1/chat/completions', false, $context);
    $response = json_decode($result, true);
    return $response['choices'][0]['message']['content'] ?? 'Summary not available';
}

$topics = ['technology', 'business', 'sports'];
$aggregatedNews = [];

foreach ($topics as $topic) {
    $news = fetchNews($topic);
    foreach ($news['articles'] as $article) {
        $summary = summarizeText($article['description'] ?? $article['content'] ?? '');
        $aggregatedNews[] = [
            'title' => $article['title'],
            'url' => $article['url'],
            'summary' => $summary,
            'source' => $article['source']['name'],
            'publishedAt' => $article['publishedAt']
        ];
    }
    sleep(1);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AI News Aggregator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">📰 Daily Digest - AI News Summaries</h1>
    <?php foreach ($aggregatedNews as $news): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                <p class="card-text"><strong>Summary:</strong> <?= htmlspecialchars($news['summary']) ?></p>
                <a href="<?= $news['url'] ?>" class="btn btn-primary" target="_blank">Read More</a>
                <p class="mt-2 text-muted">Source: <?= htmlspecialchars($news['source']) ?> | Published: <?= date('d M Y, H:i', strtotime($news['publishedAt'])) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
