# Mafia Game

Mafia The game models a conflict between two groups: an informed minority (the mafiosi or the werewolves) and an uninformed majority (the villagers). At the start of the game, you are assigned a role affiliated with one of these teams. The game has two alternating phases: first, a night-phase, during which those with night-killing-powers may covertly kill other players, and second, a day-phase, in which all surviving players debate and vote to eliminate a suspect. The game continues until a faction achieves its win-condition; for the village, this usually means eliminating the evil minority, while for the minority, this usually means reaching numerical parity with the village and eliminating any rival evil groups.


## Demo


![Demo](https://i.imgur.com/RIVC4B7.gif)

## Run Locally

Clone the project

```bash
  git clone https://github.com/drilaexe/MafiaGame
```

Go to the project directory

```bash
  cd mafiagame
```
Import the mysql database
```bash
mafiagameSql.sql
```

Install dependencies

```bash
  composer install
  copy .env.example .env
  php artisan key:generate
  php artisan migrate
  npm install
```

Start the server

```bash
  npm run dev
  php artisan serve
```
