package main

import (
	"github/labstack/echo"
	"github/labstack/echo/middleware"
	"gopkg.in/olahol/melody.v1"
)

func main(){
	e := echo.New()
	m := melody.New()

	e.Use(mmiddleware.Logger())
	e.Use(mmiddleware.Recover())

	e.Static(prefix:"/", root:"./public")
	e.GET(path:"/ws", func(c echo.Context) error {
		m.HandleRequest(c.Response(), c.Request())
		return nil
	})

	m.HandleMessage(func (s *melody.Session, msg []byte){
		m.Broadcast(msg)
	})

	e.Logget.Fatal(e.Start(address:":1323"))
}

