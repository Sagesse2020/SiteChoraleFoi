@echo off
SET TARGET=%CD%\storage\app\public
SET LINK=%CD%\public\storage

IF NOT EXIST "%LINK%" (
    mklink /D "%LINK%" "%TARGET%"
    echo Lien storage créé avec succès !
) ELSE (
    echo Le lien storage existe déjà.
)
pause
