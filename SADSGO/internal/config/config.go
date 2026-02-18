package config

import (
	"os"
	"strconv"
)

type Config struct {
	HTTPAddr   string
	DBHost     string
	DBPort     int
	DBUser     string
	DBPass     string
	DBBase     string
	DBSid      string
	User       string
	AuthBypass bool
}

func Load() Config {
	return Config{
		HTTPAddr:   getenv("SADSGO_HTTP_ADDR", ":8080"),
		DBHost:     getenv("SADSGO_DB_HOST", "127.0.0.1"),
		DBPort:     getenvInt("SADSGO_DB_PORT", 3306),
		DBUser:     getenv("SADSGO_DB_USER", "root"),
		DBPass:     getenv("SADSGO_DB_PASS", ""),
		DBBase:     getenv("SADSGO_DB_BASE", "base_sobral"),
		DBSid:      getenv("SADSGO_DB_SID", "sid"),
		User:       getenv("SADSGO_USER", "demo"),
		AuthBypass: getenvBool("SADSGO_AUTH_BYPASS", true),
	}
}

func getenv(key, def string) string {
	if v := os.Getenv(key); v != "" {
		return v
	}
	return def
}

func getenvInt(key string, def int) int {
	if v := os.Getenv(key); v != "" {
		if n, err := strconv.Atoi(v); err == nil {
			return n
		}
	}
	return def
}

func getenvBool(key string, def bool) bool {
	if v := os.Getenv(key); v != "" {
		if b, err := strconv.ParseBool(v); err == nil {
			return b
		}
	}
	return def
}
