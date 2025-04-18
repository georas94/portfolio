#!/bin/bash

# Vérifie si le réseau 'tools' existe, sinon le crée
if ! docker network inspect tools >/dev/null 2>&1; then
  echo "Le réseau 'tools' n'existe pas, création..."
  docker network create tools
else
  echo "Le réseau 'tools' existe déjà."
fi

exec "$@"
