Running server linux:

1. Ras
```bash
wget https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
sudo dpkg -i packages-microsoft-prod.deb
rm packages-microsoft-prod.deb
```
2. Dva
```bash
sudo apt-get update && \
  sudo apt-get install -y dotnet-sdk-8.0
```
3. I tri
```bash
cd /
sudo git clone "http://github.com/NThacker5246/FreeTube.git"
sudo dotnet run
```
Paroli sudo: kali/kali
