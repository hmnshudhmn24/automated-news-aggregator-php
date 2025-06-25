# 📰 Automated News Aggregator (AI + PHP)

### 📄 Project Description  
A powerful and lightweight news digest tool that fetches the latest articles from NewsAPI and summarizes them using OpenAI's GPT. Perfect for users who want short, personalized news updates across different topics.

## 🚀 Features
- 🗞️ Fetches trending news by topic (e.g., tech, business, sports)
- 🤖 Uses OpenAI GPT to summarize each article in 1-2 lines
- 🌐 Clean Bootstrap UI for readability
- ⚙️ Fully customizable topic list

## ⚙️ How to Run

### 1. 🔧 Setup
1. Get a **NewsAPI key** from [newsapi.org](https://newsapi.org/)
2. Get your **OpenAI API key** from [platform.openai.com](https://platform.openai.com/account/api-keys)

### 2. 💻 Run Locally
```bash
git clone https://github.com/yourusername/ai-news-aggregator-php.git
cd ai-news-aggregator-php
php -S localhost:8000
```

Now open your browser at:  
[http://localhost:8000/news_aggregator.php](http://localhost:8000/news_aggregator.php)

## ✏️ Configuration
- Set your preferred topics inside the `$topics` array in `news_aggregator.php`
- Replace `'YOUR_NEWSAPI_KEY'` and `'YOUR_OPENAI_API_KEY'` with your credentials
