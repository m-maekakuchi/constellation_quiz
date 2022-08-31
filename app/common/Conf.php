<?php

class Conf {
  const DATABASESOFT = 'mysql';
  const DATABASENAME = 'quiz';
  const HOST = 'localhost';
  const ENCODE = 'utf8';
  const USER = 'root';
  const PASSWORD = 'root';

  const DSN = self::DATABASESOFT.":dbname=".self::DATABASENAME.";host=".self::HOST.";charset=".self::ENCODE;
}