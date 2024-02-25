import pygame
import random

# 初期設定
pygame.init()
screen_width = 800
screen_height = 600
screen = pygame.display.set_mode((screen_width, screen_height))
clock = pygame.time.Clock()
game_over = False

# 色の定義
black = (0, 0, 0)
white = (255, 255, 255)
red = (255, 0, 0)

# プレイヤー設定
player_width = 50
player_height = 20
player_x = screen_width / 2 - player_width / 2
player_y = screen_height - player_height - 10
player_speed = 5

# 敵設定
enemy_width = 50
enemy_height = 20
enemy_speed = 2
enemies = []

# 弾設定
bullet_width = 5
bullet_height = 10
bullet_speed = 7
bullets = []

def draw_player(x, y):
    pygame.draw.rect(screen, white, [x, y, player_width, player_height])

def draw_enemy(x, y):
    pygame.draw.rect(screen, red, [x, y, enemy_width, enemy_height])

def draw_bullet(x, y):
    pygame.draw.rect(screen, white, [x, y, bullet_width, bullet_height])

# ゲームループ
while not game_over:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            game_over = True
            
    keys = pygame.key.get_pressed()
    if keys[pygame.K_LEFT] and player_x > 0:
        player_x -= player_speed
    if keys[pygame.K_RIGHT] and player_x < screen_width - player_width:
        player_x += player_speed
    if keys[pygame.K_SPACE]:
        bullets.append([player_x + player_width / 2 - bullet_width / 2, player_y])

    screen.fill(black)
    draw_player(player_x, player_y)

    # 敵の更新
    if random.randint(1, 30) == 1:
        enemies.append([random.randint(0, screen_width - enemy_width), -enemy_height])
    for enemy in enemies[:]:
        enemy[1] += enemy_speed
        draw_enemy(enemy[0], enemy[1])
        if enemy[1] > screen_height:
            enemies.remove(enemy)
    
    # 弾の更新
    for bullet in bullets[:]:
        bullet[1] -= bullet_speed
        draw_bullet(bullet[0], bullet[1])
        if bullet[1] < -bullet_height:
            bullets.remove(bullet)
    
    # 当たり判定
    for bullet in bullets[:]:
        for enemy in enemies[:]:
            if bullet[0] < enemy[0] + enemy_width and bullet[0] + bullet_width > enemy[0] and bullet[1] < enemy[1] + enemy_height and bullet[1] + bullet_height > enemy[1]:
                bullets.remove(bullet)
                enemies.remove(enemy)
                break

    pygame.display.flip()
    clock.tick(60)

pygame.quit()
