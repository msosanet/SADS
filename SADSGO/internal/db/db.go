package db

import (
	"database/sql"
	"fmt"

	_ "github.com/go-sql-driver/mysql"

	"sadsgo/internal/config"
)

type Connections struct {
	Base *sql.DB
	Sid  *sql.DB
}

func Open(cfg config.Config) (Connections, error) {
	base, err := openOne(cfg, cfg.DBBase)
	if err != nil {
		return Connections{}, err
	}

	sid, err := openOne(cfg, cfg.DBSid)
	if err != nil {
		_ = base.Close()
		return Connections{}, err
	}

	return Connections{Base: base, Sid: sid}, nil
}

func openOne(cfg config.Config, dbName string) (*sql.DB, error) {
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%d)/%s?parseTime=true&charset=utf8mb4,utf8",
		cfg.DBUser,
		cfg.DBPass,
		cfg.DBHost,
		cfg.DBPort,
		dbName,
	)

	db, err := sql.Open("mysql", dsn)
	if err != nil {
		return nil, err
	}
	if err := db.Ping(); err != nil {
		_ = db.Close()
		return nil, err
	}
	return db, nil
}
