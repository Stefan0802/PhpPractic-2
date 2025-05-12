<style>
    .gradient-text {
        font-size: 28px;
        font-weight: bold;
        background: linear-gradient(
                to right,
                rgb(255, 0, 0),
                rgb(255, 165, 0),
                rgb(255, 255, 0),
                rgb(0, 128, 0),
                rgb(0, 0, 255),
                rgb(75, 0, 130),
                rgb(238, 130, 238)
        );
        background-size: 200% 200%;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-align: center;
        animation: gradient-flow 5s ease-in-out infinite;
    }

    @keyframes gradient-flow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>

<h2 class="gradient-text"><?= $message ?? ''; ?></h2>