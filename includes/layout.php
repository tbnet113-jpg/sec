<?php
declare(strict_types=1);

function render_header(string $title): void
{
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>';
    echo '<style>
        body{font-family:Arial,Helvetica,sans-serif;max-width:900px;margin:28px auto;padding:0 16px;line-height:1.45}
        nav{margin-bottom:20px;padding:10px;background:#f2f2f2;border-radius:8px}
        nav a{margin-right:14px;text-decoration:none;color:#0056b3}
        form{max-width:560px}
        input,textarea,button{width:100%;padding:8px;margin-top:6px;margin-bottom:12px;box-sizing:border-box}
        .error{color:#b00020}
        .success{color:#0a6a0a}
        ul{padding-left:20px}
    </style></head><body>';
}

function render_menubar(): void
{
    echo '<nav>';
    echo '<a href="/socialnet/index.php">Home</a>';
    echo '<a href="/socialnet/setting.php">Setting</a>';
    echo '<a href="/socialnet/profile.php">Profile</a>';
    echo '<a href="/socialnet/about.php">About</a>';
    echo '<a href="/socialnet/signout.php">SignOut</a>';
    echo '</nav>';
}

function render_footer(): void
{
    echo '</body></html>';
}
