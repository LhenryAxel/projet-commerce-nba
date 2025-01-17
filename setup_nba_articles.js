
use nba_store;


db.createCollection("nba_articles", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: ["title", "content", "author", "team", "player"],
            properties: {
                title: {
                    bsonType: "string",
                    description: "Le titre est requis et doit être une chaîne de caractères."
                },
                content: {
                    bsonType: "string",
                    description: "Le contenu est requis et doit être une chaîne de caractères."
                },
                author: {
                    bsonType: "string",
                    description: "L'auteur est requis et doit être une chaîne de caractères."
                },
                tags: {
                    bsonType: "array",
                    items: {
                        bsonType: "string"
                    },
                    description: "Les tags doivent être un tableau de chaînes de caractères."
                },
                team: {
                    bsonType: "string",
                    description: "L'équipe est requise et doit être une chaîne de caractères."
                },
                player: {
                    bsonType: "string",
                    description: "Le joueur est requis et doit être une chaîne de caractères."
                },
                created_at: {
                    bsonType: "date",
                    description: "La date de création est requise."
                }
            }
        }
    }
});

db.nba_articles.insertMany([
    {
        "title": "Steph Curry et les Warriors",
        "content": "Steph Curry, le maître des tirs à trois points, continue de mener les Golden State Warriors vers le sommet de la NBA.",
        "author": "Admin",
        "tags": ["NBA", "Steph Curry", "Warriors"],
        "team": "Golden State Warriors",
        "player": "Steph Curry",
        "created_at": new Date()
    },
    {
        "title": "LeBron James et les Lakers",
        "content": "LeBron James prouve encore qu'il est l'un des meilleurs joueurs de l'histoire en menant les Lakers.",
        "author": "Admin",
        "tags": ["NBA", "LeBron James", "Lakers"],
        "team": "Los Angeles Lakers",
        "player": "LeBron James",
        "created_at": new Date()
    },
    {
        "title": "Kevin Durant brille avec les Suns",
        "content": "Kevin Durant continue de dominer sur le terrain avec des performances impressionnantes pour les Phoenix Suns.",
        "author": "Admin",
        "tags": ["NBA", "Kevin Durant", "Suns"],
        "team": "Phoenix Suns",
        "player": "Kevin Durant",
        "created_at": new Date()
    }
]);
