# Mission Board & Ticket System - Product Documentation

---

## What Is It?

The **Mission Board** is a new gamification feature embedded as a widget inside the casino web page. It gives players a list of tasks (missions) to complete. When they finish a mission, they earn **Tickets** and/or **Credits**. Tickets can be redeemed for **real random cash prizes**.

This feature is designed to increase player engagement, encourage deposits, and drive daily return visits.

---

## How It Works (Player Perspective)

### Step 1: Player Opens the Mission Board

The Mission Board widget appears on the casino page. At the top, the player sees their **ticket inventory** (Bronze, Silver, Gold) with the cash value range for each tier.

Below that are four tabs:

| Tab | What It Shows |
|-----|---------------|
| **Daily** | Missions that reset every 24 hours |
| **Weekly** | Missions that reset every 7 days |
| **Monthly** | Missions that reset every month |
| **Tickets** | Player's ticket inventory, redeem and exchange options |

### Step 2: Player Completes Missions

Missions are tasks based on the player's **real activity** on the casino platform:

| Mission Type | Example | How It's Tracked |
|---|---|---|
| **Deposit Count** | "Make 3 deposits this week" | Counted from casino deposit transactions |
| **Deposit Amount** | "Deposit $100 total this month" | Summed from casino deposit transactions |
| **Single Deposit** | "Make a deposit of at least $50" | Checks individual deposit amounts |
| **Game Play** | "Play 5 mini-games today" | Counted when player uses credits to play |
| **Check-in** | "Check in today" | Counted when player does daily check-in |
| **Win Prizes** | "Win 3 prizes from mini-games" | Counted when player wins any prize |

Each mission shows:
- A **progress bar** (e.g., "2 / 3 deposits")
- The **reward** they'll earn (e.g., "1 Bronze Ticket + 1 Credit")
- A **countdown timer** showing when the mission period resets

Progress updates **automatically** as the player deposits, plays games, checks in, etc.

### Step 3: Player Claims Rewards

When a mission is completed (progress bar reaches 100%), a green **"Claim Reward"** button appears. The player taps it and receives their reward:
- **Tickets** (Bronze, Silver, or Gold)
- **Credits** (used to play mini-games)
- Or **both**

A celebration popup confirms what they earned.

**Important:** Rewards are NOT automatic. The player must manually tap "Claim" - this creates an additional engagement touchpoint.

### Step 4: Player Uses Tickets

Tickets are the core reward currency. Players have three options:

#### Option A: Redeem for Cash
Each ticket can be redeemed for a **random cash prize** within its tier range:

| Ticket Tier | Cash Prize Range | Example |
|---|---|---|
| **Bronze** | $1 - $10 | Player redeems 1 Bronze Ticket, wins $7.57 |
| **Silver** | $11 - $20 | Player redeems 1 Silver Ticket, wins $14.30 |
| **Gold** | $21 - $30 | Player redeems 1 Gold Ticket, wins $27.85 |

The cash is delivered either as a **casino bonus** (via the casino platform) or as **credits** in our system, depending on how the operator configures it.

#### Option B: Exchange for Higher Tier
Players can combine lower-tier tickets to get a higher-tier ticket:

| Exchange | Rate (configurable per operator) |
|---|---|
| Bronze to Silver | e.g., 3 Bronze = 1 Silver |
| Silver to Gold | e.g., 3 Silver = 1 Gold |

This encourages players to **keep completing missions** to accumulate enough tickets for a bigger payout.

#### Option C: Hold and Collect
Players can simply hold onto their tickets and decide later whether to redeem or exchange.

---

## Why Players Will Love It

1. **Every deposit counts** - Deposits aren't just for playing casino games anymore; they also progress missions
2. **Daily reason to come back** - Fresh daily missions create a habit loop
3. **Visible progress** - Progress bars make players want to "finish what they started"
4. **Random cash excitement** - The random redemption amount adds a mini-gambling thrill
5. **Strategic choice** - "Should I redeem my 3 Bronze tickets now ($3-$30 total) or exchange them for 1 Silver ($11-$20)?" adds decision-making fun
6. **Free value** - Players earn rewards just for doing what they already do (depositing, playing)

---

## Why Operators Will Love It

1. **Drives deposits** - Missions like "Deposit 3 times this week" or "Deposit $100 this month" directly encourage more deposits
2. **Increases daily active users** - Daily missions + daily check-in missions bring players back every day
3. **Increases game plays** - "Play 5 games today" missions drive mini-game engagement
4. **Fully configurable** - Operators control which missions are active, targets, and reward amounts
5. **Configurable ticket settings** - Exchange rates and cash ranges are adjustable per operator
6. **Low cost, high perceived value** - A Bronze ticket costs $1-$10 randomly, but the "lottery" feeling makes it feel more valuable
7. **Easy to manage** - Create missions, toggle active/inactive, done. No complex season or campaign setup needed

---

## Configuration (For Operators)

### Mission Setup

Operators manage missions through the admin panel. Each mission has:

| Field | Description | Example |
|---|---|---|
| **Title** | Mission name shown to player | "Deposit 3 Times" |
| **Description** | Short explanation | "Make 3 deposits this week" |
| **Mission Type** | What activity to track | Deposit Count, Deposit Amount, Game Play, Check-in, Win Count |
| **Period** | Reset cycle | Daily, Weekly, or Monthly |
| **Target Value** | Goal number | 3 (for "3 deposits"), 100 (for "$100") |
| **Reward Type** | What to give | Tickets only, Credits only, or Both |
| **Ticket Tier** | Which ticket tier | Bronze, Silver, or Gold |
| **Ticket Quantity** | How many tickets | 1, 2, 3, etc. |
| **Credits** | How many credits | 1, 5, 10, etc. |
| **Active** | On/Off toggle | Active or Inactive |

Operators can create as many missions as they want. We recommend:
- **3 daily missions** (easy, small rewards - keeps players coming back)
- **3-4 weekly missions** (medium difficulty, medium rewards)
- **3-4 monthly missions** (challenging, big rewards like Gold tickets)

### Ticket Configuration

Each operator has their own ticket settings:

| Setting | Description | Default |
|---|---|---|
| **Bronze to Silver exchange rate** | How many Bronze = 1 Silver | 3 |
| **Silver to Gold exchange rate** | How many Silver = 1 Gold | 3 |
| **Bronze cash range** | Min and max for Bronze redemption | $1 - $10 |
| **Silver cash range** | Min and max for Silver redemption | $11 - $20 |
| **Gold cash range** | Min and max for Gold redemption | $21 - $30 |
| **Cash delivery method** | How cash is delivered to player | Casino Bonus or System Credits |

---

## Sample Mission Setup

Here's a recommended starter pack for a new operator:

### Daily Missions
| Mission | Target | Reward |
|---|---|---|
| Make a Deposit | 1 deposit | 1 Bronze Ticket |
| Play 3 Games | 3 game plays | 1 Credit |
| Daily Check-in | 1 check-in | 1 Bronze Ticket + 1 Credit |

### Weekly Missions
| Mission | Target | Reward |
|---|---|---|
| Deposit 3 Times | 3 deposits | 1 Silver Ticket |
| Deposit $100 Total | $100 in deposits | 2 Silver Tickets + 3 Credits |
| Win 5 Prizes | 5 prize wins | 3 Bronze Tickets |
| Play 15 Games | 15 game plays | 1 Gold Ticket |

### Monthly Missions
| Mission | Target | Reward |
|---|---|---|
| Deposit $500 This Month | $500 in deposits | 3 Gold Tickets + 10 Credits |
| Check In 20 Days | 20 check-ins | 2 Gold Tickets |
| Play 50 Games | 50 game plays | 5 Silver Tickets + 5 Credits |
| Deposit 10 Times | 10 deposits | 3 Silver Tickets |

---

## Player Journey Example

**Meet Tara**, a regular player:

1. **Monday morning** - Tara opens the casino, sees the Mission Board. She has 3 daily missions. She does her daily check-in and claims **1 Bronze Ticket + 1 Credit**.

2. **Monday afternoon** - She deposits $50. This progresses her daily "Make a Deposit" mission (complete - earns **1 Bronze Ticket**) AND her weekly "Deposit 3 Times" mission (1/3 done) AND her monthly "Deposit $500" mission ($50/$500).

3. **Monday evening** - She plays 3 mini-games using her credits. Completes "Play 3 Games" daily mission, earns **1 Credit**. She now has 2 Bronze Tickets.

4. **By Friday** - After depositing 3 times during the week, her weekly "Deposit 3 Times" mission completes. She claims **1 Silver Ticket**.

5. **Friday evening** - She has accumulated 3 Bronze Tickets from daily missions. She goes to the Tickets tab and **exchanges 3 Bronze for 1 Silver**. She now has **2 Silver Tickets**.

6. **She redeems 1 Silver Ticket** - The system generates a random amount between $11-$20. She wins **$16.40** as a casino bonus!

7. **Next week** - All weekly missions reset, daily missions reset each day. Tara comes back to do it all again.

---

## Technical Integration

The Mission Board is a **JavaScript widget** embedded in the casino web page. It communicates with our backend via API:

- Progress tracking is **automatic** - when the casino sends deposit webhooks, or when the player plays games/checks in, mission progress updates in real-time
- No manual tracking needed from the operator
- The widget is styled to match the casino's dark/gold aesthetic
- Works on both desktop and mobile browsers

---

## Summary

| Feature | Detail |
|---|---|
| **What** | Mission-based reward system with tiered ticket prizes |
| **Where** | JavaScript widget embedded in casino web page |
| **Player effort** | Complete missions by depositing, playing games, checking in |
| **Rewards** | Bronze/Silver/Gold Tickets + Credits |
| **Ticket redemption** | Random cash prizes ($1-$10, $11-$20, $21-$30) |
| **Ticket exchange** | Combine lower-tier tickets into higher-tier (rate configurable) |
| **Mission periods** | Daily (resets 24h), Weekly (resets 7d), Monthly (resets 30d) |
| **Operator control** | Full control over missions, targets, rewards, ticket settings |
| **Key benefit** | Drives deposits, daily visits, and game engagement |
