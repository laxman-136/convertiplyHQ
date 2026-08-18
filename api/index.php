<?php
/**
 * Vercel Serverless PHP Entry Point
 */
$_SERVER['SCRIPT_NAME'] = '/router.php';
require __DIR__ . '/../router.php';
