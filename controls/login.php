<?php

>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Login • Sistema de Chamados</title>
  <!-- usa o mesmo css da página anterior -->
  <link rel="stylesheet" href="style_std.css" />

  <!-- DIFERENÇAS ESPECÍFICAS DO LOGIN -->
  <style>
    /* centraliza o conteúdo verticalmente */
    .login-wrap{
    min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #e0e0e0; /* mesmo tom de fundo simples */
      padding: 24px;
    }
    .login-card{
    width: 100%;
    max-width: 380px;
      background: #ddd;          /* combina com os cards da listagem */
      border-radius: 8px;
      padding: 28px 22px 24px;
      box-shadow: 0 6px 18px rgba(0,0,0,.08);
      text-align: center;
    }
    .login-avatar{
    width: 72px; height: 72px;
      border-radius: 50%;
      margin: 10px auto 22px;
      background: #bbb;
      display: grid; place-items: center;
      font-size: 34px;
      color: #111;
    }
    /* campos grandes em formato “pílula” */
    .login-input{
    width: 100%;
    padding: 14px 18px;
      border: none;
      border-radius: 28px;
      background: #777;
      color: #fff;
      margin: 10px 0 14px;
      text-align: center;
      font-size: 16px;
      outline: none;
    }
    .login-input::placeholder{ color: #e9e9e9; letter-spacing: .5px; }
    .login-btn{
    width: 180px;
      margin: 8px auto 0;
      display: inline-block;
      padding: 12px 16px;
      border: none;
      border-radius: 8px;
      background: #4a4a4a;
      color: #fff; font-weight: 600;
      cursor: pointer;
    }
    .login-btn:active{ transform: translateY(1px); }
  </style>
</head>
<body>

<div class="login-wrap">
  <form class="login-card" method="post" action="/auth/login">
    <div class="login-avatar" aria-hidden="true">👤</div>

    <input
      class="login-input"
      type="text"
      name="login"
      placeholder="LOGIN"
      autocomplete="username"
      required
      />

    <input
      class="login-input"
      type="password"
      name="senha"
      placeholder="SENHA"
      autocomplete="current-password"
      required
      />

    <button class="login-btn" type="submit">Entrar</button>
  </form>
</div>

</body>
</html>
