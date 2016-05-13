#! /bin/bash
# Based on https://github.com/brollb/automerge-ci
# Merge pushes to development branch to stable branch
if [ ! -n $2 ] ; then
    echo "Usage: merge.sh <username> <password>"
    exit 1;
fi

if [ "${TRAVIS_PULL_REQUEST}" = "false" ] ; then
    echo "This is no pullrequest"
    exit 0;
fi

if [ "${MERGE}" = "false" ] ; then
    exit 0;
fi

GIT_USER="$1"
GIT_PASS="$2"

TO_BRANCH="develop"

# Get the current branch
export PAGER=cat

# Create the URL to push merge to
URL=$(git remote -v | head -n1 | cut -f2 | cut -d" " -f1)
echo "Repo url is $URL"
PUSH_URL="https://$GIT_USER:$GIT_PASS@${URL:6}"

git log -n 1 | cat

# Push changes back to remote vcs
#echo "Pushing changes..." && \
#git push $PUSH_URL && \
#echo "Merge complete!" || \
#echo "Error Occurred. Merge failed"
