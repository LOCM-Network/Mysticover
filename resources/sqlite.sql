--# !sqlite
--#{ mysticover
--#   { player
--#     { init
CREATE TABLE IF NOT EXISTS players {
    player_name TEXT NOT NULL,
    process_raw TEXT NOT NULL,
}
--#     }
--#    { select
--#         :player_name string
SELECT * FROM players WHERE player_name = :player_name
--#   }
--#   { insert
--#         :player_name string
--#         :process_raw string
INSERT INTO players (player_name, process_raw) VALUES (:player_name, :process_raw)
--#   }
--#   { update
--#         :player_name string
--#         :process_raw string
UPDATE players SET process_raw = :process_raw WHERE player_name = :player_name
--#   }
--#   { delete
--#         :player_name string
DELETE FROM players WHERE player_name = :player_name
--#   }
--# }
--#}